<?php

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

$worlddays = array(
	"1/1"	=>	"ΠΡΩΤΟΧΡΟΝΙΑ",
	"2/2"	=>	"Παγκόσμια Ημέρα των Υγρότοπων και Υδροβιότοπων",
	"14/2"	=>	"Παγκόσμια Ημέρα των Ερωτευμένων",
	"21/2"	=>	"Παγκόσμια Ημέρα της Μητρικής Γλώσσας",
	"8/3"	=>	"Παγκόσμια Ημέρα της Γυναίκας και των Δικαιωμάτων της",
	"15/3"	=>	"Παγκόσμια Ημέρα της Προστασίας του Καταναλωτή",
  "21/3"	=>	"Παγκόσμια Ημέρα της Ποίησης",
	"22/3"	=>	"Παγκόσμια Ημέρα του Νερού",
	"23/3"	=>	"Παγκόσμια Ημέρα της Μετεωρολογίας",
	"24/3"	=>	"Παγκόσμια Ημέρα κατά της Φυματίωσης",
	"27/3"	=>	"Παγκόσμια Ημέρα του Θεάτρου",
	"2/4"	=>	"Παγκόσμια Ημέρα του Παιδικού Βιβλίου",
	"7/4"	=>	"Παγκόσμια Ημέρα Υγείας",
	"18/4"	=>	"Παγκόσμια Ημέρα Μνημείων",
	"20/4"	=>	"Παγκόσμια Ημέρα Τύπου",
	"22/4"	=>	"Παγκόσμια Ημέρα της Γης",
	"23/4"	=>	"Παγκόσμια Ημέρα του Βιβλίου και των Πνευματικών Δικαιωμάτων (Copyright)",
	"1/5"	=>	"Εργατική Πρωτομαγιά",
	"3/5"	=>	"Παγκόσμια Ημέρα της Ελευθερίας του Τύπου",
	"8/5"	=>	"Παγκόσμια Ημέρα Λήξης Β' Παγκοσμίου Πολέμου",
	"9/5"	=>	"Παγκόσμια Ημέρα της Ευρώπης",
	"15/5"	=>	"Παγκόσμια Ημέρα της Οικογένειας",
	"17/5"	=>	"Παγκόσμια Ημέρα των Τηλεπικοινωνιών",
	"18/5"	=>	"Παγκόσμια Ημέρα των Μουσείων",
	"19/5"	=>	"Παγκόσμια Ημέρα του Ερυθρού Σταυρού",
	"21/5"	=>	"Παγκόσμια Ημέρα της Πολιτιστικής Ανάπτυξης",
	"31/5"	=>	"Παγκόσμια Ημέρα κατά του Καπνίσματος",
	"5/6"	=>	"Παγκόσμια Ημέρα Προστασίας Περιβάλλοντος",
	"12/6"	=>	"Παγκόσμια Ημέρα κατά της Εργασίας των Παιδιών",
	"17/6"	=>	"Παγκόσμια Ημέρα κατά της Ερημοποίησης και της Ξηρασίας",
	"20/6"	=>	"Παγκόσμια Ημέρα Προσφύγων",
	"21/6"	=>	"Παγκόσμια Ημέρα της Μουσικής",
	"26/6"	=>	"Παγκόσμια Ημέρα κατά των Ναρκωτικών",
	"2/7"	=>	"Παγκόσμια Ημέρα Συνεταιρισμών",
	"12/8"	=>	"Παγκόσμια Ημέρα της Νεότητας",
	"8/9"	=>	"Παγκόσμια Ημέρα Εξάλειψης του Αναλφαβητισμού (UNESCO)",
	"16/9"	=>	"Παγκόσμια Ημέρα Προστασίας της Ζώνης του Όζοντος",
	"20/9"	=>	"Παγκόσμια Ημέρα Χωρίς Αυτοκίνητο",
	"21/9"	=>	"Παγκόσμια Ημέρα της Ειρήνης",
	"26/9"	=>	"Παγκόσμια Ημέρα της Ναυτιλίας",
	"27/9"	=>	"Παγκόσμια Ημέρα του Τουρισμού",
	"1/10"	=>	"Παγκόσμια Ημέρα των Γηρατειών",
	"4/10"	=>	"Παγκόσμια Ημέρα των Ζώων",
	"5/10"	=>	"Παγκόσμια Ημέρα των Δασκάλων (UNESCO)",
	"9/10"	=>	"Παγκόσμια Ημέρα των Ταχυδρομείων",
	"16/10"	=>	"Παγκόσμια Ημέρα της Διατροφής και Τροφίμων",
	"17/10"	=>	"Παγκόσμια Ημέρα υπέρ της Εξάλειψης της Φτώχειας",
	"20/10"	=>	"Παγκόσμια Ημέρα κατά της Οστεοπόρωσης",
	"31/10"	=>	"Παγκόσμια Ημέρα της Αποταμίευσης",
	"14/11"	=>	"Παγκόσμια Ημέρα κατά του Διαβήτη",
	"21/11"	=>	"Παγκόσμια Ημέρα της Τηλεόρασης",
	"25/11"	=>	"Παγκόσμια Ημέρα Κατά της Βίας Εναντίον των Γυναικών",
	"1/12"	=>	"Παγκόσμια Ημέρα κατά του AIDS",
	"3/12"	=>	"Παγκόσμια Ημέρα Ατόμων με Ειδικές Ανάγκες",
	"4/12"	=>	"Παγκόσμια Ημέρα κατά των Ναρκών",
	"5/12"	=>	"Παγκόσμια Ημέρα του Εθελοντισμού",
	"7/12"	=>	"Παγκόσμια Ημέρα Πολιτικής Αεροπορίας ",
	"10/12"	=>	"Παγκόσμια Ημέρα Διεθνούς Αμνηστίας και Ανθρωπίνων Δικαιωμάτων",
	"11/12"	=>	"Παγκόσμια Ημέρα Παιδιού",
	"18/12"	=>	"Παγκόσμια Ημέρα για τους μετανάστες ",
);
?>