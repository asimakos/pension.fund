<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools
* @author: Benny Sparano (benny3@chelsea.ios.com). Improvments by Carlos Marangon (hpfb@hotmail.com)
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: An advanced javascript Calculator
* @note: Implemented in Elxis as a tool by Ioannis Sannos (datahell@elxis.org)
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $mainframe, $adminLanguage;
$calc_baseurl = $mainframe->getCfg('live_site').'/administrator/tools/calculator/';
?>

<script type="text/javascript">
function addChar(input, character) {
    if(input.value == null || input.value == "0")
        input.value = character
    else
        input.value += character
}
function cos(form) {
   form.display.value = Math.cos(form.display.value); 
}
function sin(form){
   form.display.value = Math.sin(form.display.value); 
}
function tan(form){
   form.display.value = Math.tan(form.display.value); 
}
function sqrt(form){
   form.display.value = Math.sqrt(form.display.value); 
}
function ln(form){
   form.display.value = Math.log(form.display.value); 
}
function exp(form){
   form.display.value = Math.exp(form.display.value); 
}
function deleteChar(input){
    input.value = input.value.substring(0, input.value.length - 1)
}
function changeSign(input){
    // could use input.value = 0 - input.value, but let's show off substring
    if(input.value.substring(0, 1) == "-")
        input.value = input.value.substring(1, input.value.length)
    else
        input.value = "-" + input.value
}
function compute(form) {
        form.display.value = eval(form.display.value)
}
function square(form) {
        form.display.value = eval(form.display.value) * eval(form.display.value)
}
function xxx(form) {
        form.display.value = 1 / eval(form.display.value);
}
function pi(form) {
        form.display.value = Math.PI ;
}
function acos(form) {
        form.display.value = Math.acos(form.display.value); 
}
function asin(form) {
        form.display.value = Math.asin(form.display.value); 
}
function atan(form) {
        form.display.value = Math.atan(form.display.value); 
}
function pow10(form) {
        form.display.value = Math.pow(10,form.display.value); 
}
function logg(form) {
        form.display.value = ( 1/Math.LN10 ) * Math.log(form.display.value); 
}
function rd(form) {
        form.display.value = 57.29577951308232 * (form.display.value);
}
function dr(form) {
        form.display.value = (1 / 57.29577951308232) * (form.display.value);
}
function sinh(form) {
        form.display.value = (Math.exp(form.display.value) - (1/Math.exp(form.display.value)))/2;
}
function cosh(form) {
        form.display.value = (Math.exp(form.display.value) + Math.exp(-form.display.value))/2;
}
function tanh(form) {
        form.display.value = (Math.exp(form.display.value) - 1/Math.exp(form.display.value))/(Math.exp(form.display.value) + 1/Math.exp(form.display.value));
}
function x3(form) {
        form.display.value = (form.display.value)*(form.display.value)*(form.display.value) ;
}
function perc(form) {
        form.display.value = (form.display.value)/100 ;
}
function round(form) {
        form.display.value = Math.random(form.display.value) ;
}
function area(form) {
        form.display.value = Math.PI * (form.display.value) * (form.display.value) ;
}
function volume(form) {
        form.display.value =  Math.PI * (4/3)* (form.display.value) * (form.display.value) * (form.display.value) ;
}
function crt(form) {
        form.display.value = Math.exp((1/3)*(Math.log(form.display.value)));
}
function cf(form) {
        form.display.value = ( ( (9 * form.display.value )+ 160)/5);
}
function fc(form) {
        form.display.value = ((5/9) * (((form.display.value)-32)));
}
function mk(form) {
        form.display.value = ( 3.6 * (form.display.value));
}
function km(form) {
        form.display.value = ((form.display.value)/3.6);
}
function cbrt(form) {
form.display.value = form.display.value
        if (form.display.value > 0)     {
                  form.display.value = Math.exp((1/3)*(Math.log(form.display.value)));
        }
        else    {
                 form.display.value =-1* Math.exp((1/3)*(Math.log(Math.abs(form.display.value))));
        }
}
function AbrirJanela() {
   open("<?php echo $calc_baseurl; ?>baseexpoent.html","window","location,resize,height=250,width=400,toolbar, scrollbars");
}

function checkNum(str) {
        for (var i = 0; i < str.length; i++) {
                var ch = str.substring(i, i+1)
                if (ch < "0" || ch > "9") {
                        if (ch != "/" && ch != "*" && ch != "+" && ch != "-" && ch != "."
                                && ch != "(" && ch!= ")") {
                                alert("Invalid Entry!")
                                return false
                        }
                }
        }
        return true
}
</script>

<div style="border: 1px solid #DDDDDD; padding:10px 10px 10px 50px;">
<form>
<table style="border: 2px solid #64711E;">
<tr>
    <td colspan="5" align="center" bgcolor="#A6B555" height="30"><input name="display" value="0" size="60" /></td>
</tr>
<tr bgcolor="#DEE6B3" align="center">
    <td><input type="button" class="button" value=" exp   " onclick="if (checkNum(this.form.display.value)) { exp(this.form) }" /></td>
    <td><input type="button" class="button" value="     7    " onclick="addChar(this.form.display, '7')" /></td>
    <td><input type="button" class="button" value="    8    " onclick="addChar(this.form.display, '8')" /></td>
    <td><input type="button" class="button" value="    9    " onclick="addChar(this.form.display, '9')" /></td>
    <td><input type="button" class="button" value="      /    " onclick="addChar(this.form.display, '/')" /></td>
</tr>
<tr bgcolor="#DEE6B3" align="center">
    <td><input type="button" class="button" value="    ln    " onclick="if (checkNum(this.form.display.value)){ ln(this.form) }" /></td>
    <td><input type="button" class="button" value="    4     " onclick="addChar(this.form.display, '4')" /></td>
    <td><input type="button" class="button" value="    5    " onclick="addChar(this.form.display, '5')" /></td>
    <td><input type="button" class="button" value="    6    " onclick="addChar(this.form.display, '6')" /></td>
    <td><input type="button" class="button" value="     *     " onclick="addChar(this.form.display, '*')" /></td>
</tr>
<tr bgcolor="#DEE6B3" align="center">
    <td><input type="button" class="button" value="  sqrt  " onclick="if (checkNum(this.form.display.value)){ sqrt(this.form) }" /></td>
    <td><input type="button" class="button" value="     1    " onclick="addChar(this.form.display, '1')" /></td>
    <td><input type="button" class="button" value="    2    " onclick="addChar(this.form.display, '2')" /></td>
    <td><input type="button" class="button" value="    3    " onclick="addChar(this.form.display, '3')" /></td>
    <td><input type="button" class="button" value="     -     " onclick="addChar(this.form.display, '-')" /></td>
</tr>
<tr bgcolor="#DEE6B3" align="center">
    <td><input type="button" class="button" value="    X&#178;   " onclick="if (checkNum(this.form.display.value)){ square(this.form) }" /></td>
    <td><input type="button" class="button" value="     0    " onclick="addChar(this.form.display, '0')" /></td>
    <td><input type="button" class="button" value="     .     " onclick="addChar(this.form.display, '.')" /></td>
    <td><input type="button" class="button" value="  +/-   " onclick="changeSign(this.form.display)" /></td>
    <td><input type="button" class="button" value="    +     " onclick="addChar(this.form.display, '+')" /></td>
</tr>
<tr bgcolor="#DEE6B3" align="center">
    <td><input type="button" class="button" value="  1/x   " onclick="if (checkNum(this.form.display.value)){ xxx(this.form) }" /></td>
    <td><input type="button" class="button" value="  cos  " onclick="if (checkNum(this.form.display.value)){ cos(this.form) }" /></td>
    <td><input type="button" class="button" value="   sin  " onclick="if (checkNum(this.form.display.value)){ sin(this.form) }" /></td>
    <td><input type="button" class="button" value="  tan  " onclick="if (checkNum(this.form.display.value)){ tan(this.form) }" /></td>
    <td><input type="button" class="button" name="JanelaButton"  value="   X^Y   " onclick="AbrirJanela()" /></td>
</tr>
<tr bgcolor="#DEE6B3" align="center">
    <td><input type="button" class="button" value="    pi   " onclick="if (checkNum(this.form.display.value)){ pi(this.form) }" /></td>
    <td><input type="button" class="button" value=" acos" onclick="if (checkNum(this.form.display.value)){ acos(this.form) }" /></td>
    <td><input type="button" class="button" value=" asin " onclick="if (checkNum(this.form.display.value)){ asin(this.form) }" /></td>
    <td><input type="button" class="button" value=" atan" onclick="if (checkNum(this.form.display.value)){ atan(this.form) }" /></td>
    <td><input type="button" class="button" value="  x^3   " onclick="if (checkNum(this.form.display.value)){ x3(this.form) }" /></td>
</tr>
<tr bgcolor="#DEE6B3" align="center">
    <td><input type="button" class="button" value=" Rnd " onclick="if (checkNum(this.form.display.value)){ round(this.form) }" /></td>
    <td><input type="button" class="button" value=" sinh  " onclick="if (checkNum(this.form.display.value)){ sinh(this.form) }" /></td>
    <td><input type="button" class="button" value=" cosh"  onclick="if (checkNum(this.form.display.value)){ cosh(this.form) }" /></td>
    <td><input type="button" class="button" value=" tanh"  onclick="if (checkNum(this.form.display.value)){ tanh(this.form) }" /></td>
    <td><input type="button" class="button" value="  cbrt  " onclick="if (checkNum(this.form.display.value)){ cbrt(this.form) }" /></td>
</tr>
<tr bgcolor="#DEE6B3" align="center">
    <td><input type="button" class="button" value="  Log " onclick="if (checkNum(this.form.display.value)){ logg(this.form) }" /></td>
    <td><input type="button" class="button" value=" 10^x " onclick="if (checkNum(this.form.display.value)){ pow10(this.form) }" /></td>
    <td><input type="button" class="button" value="D->R " onclick="if (checkNum(this.form.display.value)){ dr(this.form) }" /></td>
    <td><input type="button" class="button" value="R->D "  onclick="if (checkNum(this.form.display.value)){ rd(this.form) }" /></td>
    <td><input type="button" class="button" value="C-->F " onclick="if (checkNum(this.form.display.value)){cf(this.form) }" /></td>
</tr>
<tr align="center" bgcolor="#DEE6B3">
    <td><input type="button" class="button" value="    A    " onclick="if (checkNum(this.form.display.value)){ area(this.form) }" /></td>
    <td><input type="button" class="button" value="    V    " onclick="if (checkNum(this.form.display.value)){ volume(this.form) }" /></td>
    <td><input type="button" class="button" value="     (     " onclick="addChar(this.form.display, '(')" /></td>
    <td><input type="button" class="button" value="     )     " onclick="addChar(this.form.display, ')')" /></td>
    <td><input type="button" class="button" value="F-->C" onclick="if (checkNum(this.form.display.value)){ fc(this.form) }" /></td>
</tr>
<tr bgcolor="#DEE6B3" align="center">
    <td><input type="button" class="button" value="m/s->kph" onclick="if (checkNum(this.form.display.value)){ mk(this.form) }" /></td>
    <td><input type="button" class="button" value="kph->m/s " onclick="if (checkNum(this.form.display.value)){ km(this.form) }" /></td>
    <td><input type="button" class="button" value="   <--   " onclick="deleteChar(this.form.display, '(')" style="background:red;color:white;" /></td>
    <td><input type="button" class="button" value="C/CE " onclick="this.form.display.value = 0 " style="background:red;color:white;" /></td>
    <td><input type="button" class="button" value="ENTER" name="enter" onclick="if (checkNum(this.form.display.value)){ compute(this.form) }" style="background:red;color:white;" /></td>
</tr>
</table>
</form>
</div>
