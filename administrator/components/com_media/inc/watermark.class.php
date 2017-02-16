<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Media
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class watermark {

    public $file; //original image absolute path
    public $font; //ttf font file
    public $width; //original image width
    public $height; //original image height
    public $posx = '10'; //x-axis position (top left corner)
    public $posy = '10'; //y-axis position (top left corner)
    public $watertype = 'text'; //text or image
    public $text; //watermark text
    public $fontsize = '12';
    public $savedir; //renamed from $path
    public $ext; //original image extension
    public $source; //original image loaded with imagecreatefrom...(jpeg|gif|png)
    public $filename; //final image filename
    public $existephoto; //boolean (file exists or not)
    public $photo; //new image created with imagecreatetruecolor
    public $force = false; //force creation of new image
    public $fontcolor = array(); //rgb array of font color
    public $fontshadow=''; //font shadow (auto calculation)
   	public $preview = false; //preview final image
   	public $quality = '80'; //final image quality (valid for jpg, jpeg)
    public $outfile; //final output file absolute path
    public $overimage; //full path to the overlay image
    public $overlay; //overlay image loaded with imagecreatefrom...(jpeg|gif|png)
    public $_error = 0;

    /**************/
    /* CONTRUCTOR */
    /**************/
    public function __construct($file, $watertype='text', $posx, $posy) {
        global $mosConfig_absolute_path;

        $this->file = $file;
        $this->font = $mosConfig_absolute_path.'/administrator/components/com_media/inc/verdana.ttf';
        list( $this->width, $this->height ) = getimagesize($this->file);
        $this->watertype = $watertype;
        $this->posx = $posx;
        $this->posy = $posy;
    }


    /***************************/
    /* GENERATE TEXT WATERMARK */
    /***************************/
    function textmark($text, $fontsize=12, $force=false, $preview=false, $fontshadow='', $opacity='100') {
        $this->text = $text;
        $this->fontsize = $fontsize;
        $this->posy = ($this->posy + $fontsize); //position correction (from upper to lower left corner)
        $this->force = $force;
        $this->preview = $preview;
        $this->fontshadow = $fontshadow;

        $this->load_photo();

        if ($this->force || !$this->existephoto) {
            $this->photo = imagecreatetruecolor( $this->width, $this->height );
            $mark = imagecreatetruecolor( $this->width, $this->height );

            $fcolor = imagecolorallocate($this->photo, $this->fontcolor[0], $this->fontcolor[1], $this->fontcolor[2]);

            //free memory
            imagecopy( $this->photo, $this->source, 0, 0, 0, 0, $this->width, $this->height );
            imagecopy( $mark, $this->source, 0, 0, 0, 0, $this->width, $this->height );

            if ($this->fontshadow != '') {
                switch ($this->fontshadow) {
                    case 'black':
                        $scolor1  = imagecolorallocate($this->photo, 40, 40, 40);
                        $scolor2  = imagecolorallocate($this->photo, 0, 0, 0);
                    break;
                    case 'white':
                    default:
                        $scolor1  = imagecolorallocate($this->photo, 204, 204, 204);
                        $scolor2  = imagecolorallocate($this->photo, 255, 255, 255);
                    break;
                }

                imagettftext($mark, $this->fontsize, 0, $this->posx+2, $this->posy+2, $scolor2, $this->font, $this->text);
                imagettftext($mark, $this->fontsize, 0, $this->posx, $this->posy-1, $scolor1, $this->font, $this->text);
                imagettftext($mark, $this->fontsize, 0, $this->posx-1, $this->posy, $scolor1, $this->font, $this->text);
                imagettftext($mark, $this->fontsize, 0, $this->posx-1, $this->posy-1, $scolor1, $this->font, $this->text);
                imagettftext($mark, $this->fontsize, 0, $this->posx, $this->posy+1, $scolor1, $this->font, $this->text);
                imagettftext($mark, $this->fontsize, 0, $this->posx+1, $this->posy+1, $scolor1, $this->font, $this->text);
                imagettftext($mark, $this->fontsize, 0, $this->posx+1, $this->posy, $scolor1, $this->font, $this->text);
            }

            imagettftext($mark, $this->fontsize, 0, $this->posx, $this->posy, $fcolor, $this->font, $this->text);
            imagecopymerge( $this->photo, $mark, 0, 0, 0, 0, $this->width, $this->height, $opacity );

            $this->save_photo();

           //free memory
            imagedestroy( $this->photo );
            imagedestroy( $mark );
        } else {
            $this->outfile=$this->savedir.$this->filename;
        }

        //free memory
        imagedestroy( $this->source );
    }


    /****************************/
    /* GENERATE IMAGE WATERMARK */
    /****************************/
    function imagemark($overimage, $force=false, $preview=false, $opacity='100') {
        $this->overimage = $overimage;
        list( $owidth, $oheight ) = getimagesize($this->overimage);
        $this->force = $force;
        $this->preview = $preview;

        $this->load_photo();
        $this->load_overphoto();

        if ($this->force || !$this->existephoto) {
            $this->photo = imagecreatetruecolor( $this->width, $this->height );
            $mark = imagecreatetruecolor( $owidth, $oheight );

            //free memory
            imagecopy( $this->photo, $this->source, 0, 0, 0, 0, $this->width, $this->height );
            imagecopy( $mark, $this->overlay, 0, 0, 0, 0, $owidth, $oheight );
            imagecopymerge( $this->photo, $mark, $this->posx, $this->posy, 0, 0, $owidth, $oheight, $opacity );

            $this->save_photo();

           //free memory
            imagedestroy( $this->photo );
            imagedestroy( $mark );
        } else {
            $this->outfile=$this->savedir.$this->filename;
        }

        //free memory
        imagedestroy( $this->source );
        imagedestroy( $this->overlay );
    }


    /***********************/
    /* LOAD ORIGINAL PHOTO */
    /***********************/
    function load_photo() {
        global $fmanager;

        $this->ext = $fmanager->fileExt($this->file);
        switch($this->ext) {
            case 'jpeg':
            case 'jpg':
                $this->source = imagecreatefromjpeg( $this->file );
                break;
            case 'gif':
                $this->source = imagecreatefromgif( $this->file );
                break;
            case 'png':
                $this->source = imagecreatefrompng( $this->file );
                break;
        }
        $this->existephoto = (is_file($this->savedir.$this->filename));
    }


    /**********************/
    /* LOAD OVERLAY PHOTO */
    /**********************/
    function load_overphoto() {
        global $fmanager;

        $ext = $fmanager->fileExt($this->overimage);
        switch($ext) {
            case 'jpeg':
            case 'jpg':
                $this->overlay = imagecreatefromjpeg( $this->overimage );
                break;
            case 'gif':
                $this->overlay = imagecreatefromgif( $this->overimage );
                break;
            case 'png':
                $this->overlay = imagecreatefrompng( $this->overimage );
                break;
        }
    }


    /****************************/
    /* SAVE/DISPLAY FINAL PHOTO */
    /****************************/
    function save_photo() {
        global $fmanager;

       	if ($this->preview) {
			@header('Content-type: image/'.($this->ext == 'jpg' ? 'jpeg' : $this->ext));
			@header('Content-Transfer-Encoding: binary');
			@header('Content-Disposition: inline; filename='.basename($this->filename));
			@header("Cache-control: private");
		}
        @imagesetthickness($this->photo,1);
       	switch($this->ext){
		case 'jpeg':
		case 'jpg':
			$k = imagejpeg($this->photo, $this->preview ? '' : $this->savedir.$this->filename, $this->quality );
			if (!$k) { $this->_error = 1; }
			break;
		case 'gif':
			$k = imagegif($this->photo, $this->preview ? '' : $this->savedir.$this->filename );
			if (!$k) { $this->_error = 1; }
            break;
		case 'png':
			$k = imagepng($this->photo, $this->preview ? '' : $this->savedir.$this->filename );
			if (!$k) { $this->_error = 1; }
			break;
		}
	    $this->outfile = $this->savedir.$this->filename;
	    if ((!$this->_error) && (!$this->preview)) {
	       $fmanager->spChmod($this->outfile, '0666');
	    }
    }

}

?>
