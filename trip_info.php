<?php
  session_start();
if ($_SESSION['logged']!=true)
   {
 include('index.php');
 exit;
   } 
?>
<!DOCTYPE HTML>
<html lang="pl"><head>
		<link rel="stylesheet" href="hint.css">
	<meta charset="utf-8"><title>Dzienniczek ucznia online - Strefa ucznia</title>
	<meta name="description" content="Dzienniczek ucznia online - Ocenownik - Strefa klasy">
	<meta name="keywords" content="sprawdziany, kartkówki, oceny, spóźnienia, zadania domowe, odpowiedź ustna, e-wywiadówki">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="stylesheet" href="css/style.css" type="text/css">

	<link href="http://fonts.googleapis.com/css?family=Lato:400,900&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css"></head><body>
	<div id="container">
<div style="text-align: center;">
	
		</div>
<div style="text-align: center; font-family: Century Gothic;" id="logo"><big>Ocenownik</big>
		</div>
		
		<div style="font-family: Century Gothic;" id="menu">
<div class="option"><a href="index.php">Strona główna</a><br>
</div>
<?php
 session_start();
   if ($_SESSION['logged']==true)
       {
        echo ('<div class="option"><a href="download.php">Pobieranie</a></div>');
        }
        else
        {
        echo ('<div class="option"><a href="register.php">Rejestracja</a></div>');
        }
?>
			
      
      	<div class="option"><a href="bug_report.php">Zgłoś błąd lub propozycję</a></div>
			<div class="option"><a href="who.php">Do czego to służy?</a></div>
      <div class="option"><a href="faq.php">FAQ</a></div>
			<div class="option"><a href="contact.php">Kontakt</a></div>
			<div style="clear: both;"></div>
		</div>
		
		<div style="font-family: Century Gothic;" id="topbar">
			<div id="topbarL">
				<img src="ksiazki_4.gif" style="border: 0" width="150" alt="">
			</div>
			<div id="topbarR">


				<div style="text-align: center;">
				<span class="bigtitle">O programie</span></div><div style="height: 15px;"></div> </div>
			<div style="clear: both;"></div>
		</div>
    <?php
  if ($_SESSION ['logged']==true && $_SESSION ['komunikat']!='nie' )
     
     {
   echo ('	<div style="font-family: Century Gothic;" id="topbar7">
				<div style="text-align: center;">
				<span class="bigtitle3">Zalogowany jako:<b> '.$_SESSION ['userek'].'</b><br /><br /><form name="" action="logout.php" method="post">
<input value="Wyloguj się" type="submit">
  </form></span></div>
			
		</div>');}
?>
		<div style="font-family: Century Gothic;" id="sidebar">
			<b>MENU</b>
      <hr COLOR="BLACK" SIZE="1">
      
      <?php
 session_start();
   if ($_SESSION['logged']!=true)

        {
        echo ('<div class="optionL"><a id="hrf2" href="index.php">Logowanie</a></div>
    	<div class="optionL"><a id="hrf2" href="register.php">Rejestracja</a></div>');
        }
?>
      
      <div class="optionL"><a id="hrf2" href="download.php">Do pobrania</a></div>
      <div class="optionL"><a id="hrf2" href="info.php">Informacje</a></div>
      <?php
       session_start();
      include('engine/engine.php');
       if ($_SESSION['logged']==true)
       {
        echo (create_down_menu());
        }
        
      ?>
		</div>
		<div style="font-family: Century Gothic;" id="content">
<div style="text-align: center; text-decoration: underline;">
			<span class="bigtitle">Strefa klasy</span></div>
			<div class="dottedline"></div>
<?php
session_start();
  if ($_SESSION ['logged']==true && $_SESSION ['komunikat']!='nie' )
     
     {
   echo ('	<div style="font-family: Century Gothic;" id="topbar7">
				<div style="text-align: center;">
				<span class="bigtitle3">Jesteś zalogowany do klasy:<b> '.$_SESSION ['klasa'].'</b><br /><br /><form name="" action="student_zona_who.php" method="post">
<input value="Co to jest strefa klasy?" type="submit">
  </form></span></div>
			
		</div>');}
?>
      <div class="dottedline"></div>
      	<div style="font-family: Century Gothic;" id="menu2">
    <b> <center> <div class="option2"><a href="homeworks.php">Zadania domowe</a></div>
			<div class="option2"><a href="write_works.php">Kartkówki i sprawdziany</a></div>
      <div class="option2"><a href="answer.php">Terminy uroczystości klasowych</a></div>
			<div class="option2"><a href="class_other.php">Różne</a></div>
			<div  style="clear: both;"></div></center>
		</div>
<div style="text-align: center;">

  </big>
	</div>
	<div class="dottedline"></div>
  <div style="text-align: center; ">
  <b><span style="text-decoration: underline"><span style="font-size: 26pt">Informacje o wycieczkach szkolnych</span></span></b>
<br /></b><br />
<span style="text-decoration: underline"><span style="font-size: 23pt">Sczegółowe informacje o wycieczce:</span></span>
<br /><br /><hr />
<span style="font-size: 16pt;"></center><?php
session_start();
include 'config.php';
db_connect();
$user    = $_SESSION['userek'];
$trip_ID = $_GET['tripid'];
$temp4   = true;
// zapytanie
$result  = mysql_query("SELECT * FROM trips WHERE id='" . $_GET['tripid'] . "'");
// koniec zapytania
$row     = mysql_fetch_array($result);

 $__database_czyjedzie_uchwyt = mysql_query("SELECT * FROM tripczyjedzie WHERE tmp='" . $_GET['tripid'] . "' AND user='" . $user . "'");
            while ($__database_czyjedzie = mysql_fetch_array($__database_czyjedzie_uchwyt))
              {
                $wartosc_oceny = $__database_czyjedzie['value'];
              } 
    if ($wartosc_oceny == "1" || $wartosc_oceny == "0")
      {
$temp4   = true;
}

if (isset($_GET['notevalue']))
  {

 $note_id =  clear($_GET['tripid']);
$gwiazdki2 = mysql_query("SELECT * FROM tripnotes WHERE `tmp`='$note_id' and `user`='$user'");
   $ctui = mysql_num_rows($gwiazdki2);

    if ($ctui == 0)
{   
 

  $ile_gwiazd =  clear($_GET['notevalue']);
  
  if ($ile_gwiazd > 0 && $ile_gwiazd < 6)
     {
        
     mysql_query("INSERT INTO `tripnotes` (
      `user` , 
      `value`,
      `tmp`
    )
    VALUES (
    '$user', '$ile_gwiazd', '$trip_ID');");
    echo ('<div style="font-family: Century Gothic;" id="topbar11">
                <div style="text-align: center;">
                <span class="bigtitle3"><b><span style="text-decoration: underline">Ocena zadowolenia z tej wycieczki została pomyślnie dodana!</span></b><br /><br />
<a id="hrf2" href="trip_info.php?tripid=' . $trip_ID . '"><input value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" type="submit"></a>
</span></div>
        </div><hr />');
     }
      else
{
echo ('<div style="font-family: Century Gothic;" id="topbar5">
                <div style="text-align: center;">
                <span class="bigtitle3">Nieprawidłowa liczba gwiazdek!</span></div>
        </div><br />');
}
}


else

{
 echo ('<div style="font-family: Century Gothic;" class="topbar31">
                <div style="text-align: center;">
                <span class="bigtitle3">Już oddałeś/aś głos na ten wpis!</span></div>
        </div><hr />');
}


}

if (isset($_GET['backczyjedzie']))
  {
    if ($_GET['backczyjedzie'] == "1")
      {
        mysql_query("DELETE FROM tripczyjedzie WHERE tmp='" . $_GET['tripid'] . "' AND user='" . $user . "'");
        $temp4 = false;
        echo ('<div style="font-family: Century Gothic;" id="topbar11">
                <div style="text-align: center;">
                <span class="bigtitle3"><b><span style="text-decoration: underline">Zadanie wykonane pomyślnie!</span></b><br /><br />
<a id="hrf2" href="trip_info.php?tripid=' . $trip_ID . '"><input value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" type="submit"></a>
</span></div>
        </div><hr />');
      }
  }
if (isset($_GET['czyjid']))
  {

    $__database_czyjedzie_uchwyt = mysql_query("SELECT * FROM tripczyjedzie WHERE tmp='" . $_GET['tripid'] . "' AND user='" . $user . "'");
            while ($__database_czyjedzie = mysql_fetch_array($__database_czyjedzie_uchwyt))
              {
                $wartosc_oceny = $__database_czyjedzie['value'];
              } 
    if ($wartosc_oceny == "1" || $wartosc_oceny == "0")
      {
        
            $temp4 = false;
          
        echo ('<div style="font-family: Century Gothic;" class="topbar32">
                <div style="text-align: center;">
                <span class="bigtitle3"><b><span style="color: #000000">Wystapił potencjalny błąd!</span></b></span></div>
        </div><hr />');
      }
    else
      {
        $czyjedzie = clear($_GET['czyjid']);
        if ($czyjedzie != 0 && $czyjedzie != 1)
          {
            echo ('<div style="font-family: Century Gothic;" class="topbar31">
                <div style="text-align: center;">
                <span class="bigtitle3"><b>Wystapił błąd krytyczny! <span style="text-decoration: underline">Spróbuj ponownie</span>!</b></span></div>
        </div><hr />');
          }
        else
          {
            mysql_query("INSERT INTO `tripczyjedzie` (
                                 `user` , 
                                 `value`,
                                 `tmp`
                                     )
                                     VALUES (
                                      '$user', '$czyjedzie','$trip_ID');");
            echo ('<div style="font-family: Century Gothic;" id="topbar11">
                <div style="text-align: center;">
                <span class="bigtitle3"><b><span style="text-decoration: underline">Zadanie wykonane pomyślnie!</span></b><br /><br />
<a id="hrf2" href="trip_info.php?tripid=' . $trip_ID . '"><input value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" type="submit"></a>
</span></div>
        </div><hr />');
            $__database_czyjedzie_uchwyt = mysql_query("SELECT * FROM tripczyjedzie WHERE tmp='" . $_GET['tripid'] . "' AND user='" . $user . "'");
            while ($__database_czyjedzie = mysql_fetch_array($__database_czyjedzie_uchwyt))
              {
                $wartosc_oceny = $__database_czyjedzie['value'];
              }
            if ($wartosc_oceny == "1")
              {
                $czyjedzie_odp = "Jadę na wycieczkę";
              }
            if ($wartosc_oceny == "0")
              {
                $czyjedzie_odp = "Nie jadę na wycieczkę";
              }
          }
      }
  }
if (isset($_GET['tripid']))
  {
    $zmienna10 = "'images/yes_h.png'";
    $zmienna11 = "'images/yes.png'";
    $zmienna12 = "'images/no_h.png'";
    $zmienna13 = "'images/no.png'";
    echo ($__database_czyjedzie['value']);
    echo ('<span style="text-decoration: underline">Temat wycieczki:</span> <b>' . $row['gdzie'] . '</b><hr />');
    echo ('<span style="text-decoration: underline">Opis wycieczki:</span><br /><b>' . $row['opis'] . '</b><hr />');
    echo ('<span style="text-decoration: underline">Termin wycieczki:</span> <b>' . $row['data'] . '</b><hr />');
    echo ('<span style="text-decoration: underline">Uwagi odnośnie wycieczki:</span><b> ' . $row['uwagi'] . '</b><hr />');
    echo ('<span style="text-decoration: underline">Data dodania informacji o wycieczce:</span><b> ' . $row['adddate'] . '</b><hr />');
 $__database_czyjedzie_uchwyt = mysql_query("SELECT * FROM tripczyjedzie WHERE tmp='" . $_GET['tripid'] . "' AND user='" . $user . "'");
            while ($__database_czyjedzie = mysql_fetch_array($__database_czyjedzie_uchwyt))
              {
                $wartosc_oceny = $__database_czyjedzie['value'];
              } 
 if ($wartosc_oceny == "1")
              {
                $czyjedzie_odp = "Jadę na wycieczkę";
              }
            else if ($wartosc_oceny == "0")
              {
                $czyjedzie_odp = "Nie jadę na wycieczkę";
              } else
{

$temp4 = false;
}   

if ($temp4 == true)
      {
//echo ($wartosc_oceny);
        echo ('<span style="text-decoration: underline">Czy jedziesz na tą wycieczkę?</span><br /><br />
Udzieliłeś już odpowiedzi na to pytanie! <b>|</b> <a id="hrf2" href="trip_info.php?tripid=' . $trip_ID . '&backczyjedzie=1"><span style="color: #000080">Cofnij moją odpowiedź</span></a>
<br />Twoja odpowiedź: <b>' . $czyjedzie_odp . '</b><hr />');
      }
    else
      {
        echo ('<span style="text-decoration: underline">Czy jedziesz na tą wycieczkę?</span><br /><br />
 <a href="trip_info.php?czyjid=1&tripid=' . $trip_ID . '"><img onmouseover="this.src=' . $zmienna10 . '" onmouseout="this.src=' . $zmienna11 . '" src="images/yes.png"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="trip_info.php?czyjid=0&tripid=' . $trip_ID . '"><img onmouseover="this.src=' . $zmienna12 . '" onmouseout="this.src=' . $zmienna13 . '" src="images/no.png"/></a> <hr />');
      }
    $zmienna2 = "'images/star1.png'";
    $zmienna3 = "'images/star2.png'";
    $zmienna1 = 'onmouseover="this.src=' . $zmienna3 . '" onmouseout="this.src=' . $zmienna2 . '"';
    /// gwiazdka 2
    $zmienna4 = "'images/star3.png'";
    $zmiennab = 'onmouseover="this.src=' . $zmienna4 . '" onmouseout="this.src=' . $zmienna2 . '"';
    /// gwiazdka 3
    $zmienna5 = "'images/star4.png'";
    $zmiennac = 'onmouseover="this.src=' . $zmienna5 . '" onmouseout="this.src=' . $zmienna2 . '"';
    /// gwiazdka 4
    $zmienna6 = "'images/star5.png'";
    $zmiennad = 'onmouseover="this.src=' . $zmienna6 . '" onmouseout="this.src=' . $zmienna2 . '"';
    /// gwiazdka 5
    $zmienna7 = "'images/star6.png'";
    $zmiennae = 'onmouseover="this.src=' . $zmienna7 . '" onmouseout="this.src=' . $zmienna2 . '"';
    echo ("<span style='text-decoration: underline'>W jakim stopniu jesteś zadowolony/a z tej wycieczki szkolnej?</span><br /><br />
 <a href='trip_info.php?tripid=$trip_ID&noteid=" . $id2 . "&notevalue=1'><img src='images/star1.png' " . $zmienna1 . " class='star2' /></a>
<a href='trip_info.php?tripid=$trip_ID&noteid=" . $id2 . "&notevalue=2'><img src='images/star1.png' " . $zmiennab . " class='star2' /></a>
<a href='trip_info.php?tripid=$trip_ID&noteid=" . $id2 . "&notevalue=3'><img src='images/star1.png' " . $zmiennac . " class='star2' /></a>
<a href='trip_info.php?tripid=$trip_ID&noteid=" . $id2 . "&notevalue=4'><img src='images/star1.png' " . $zmiennad . " class='star2' /></a>
<a href='trip_info.php?tripid=$trip_ID&noteid=" . $id2 . "&notevalue=5'><img src='images/star1.png' " . $zmiennae . " class='star2' /></a>
<br /> <hr />");
// kod odpowiedzialny za obsługę oceny zadowolenia ---------/////////////////////
$result2      = mysql_query("SELECT * FROM tripnotes WHERE `user`='$user' and `tmp`='$trip_ID'");
$wynik2       = mysql_num_rows($result2);
        $selocenanum = mysql_num_rows($result2);
        while ($row2 = mysql_fetch_array($result2)) {
            $sumaocen = $sumaocen + (int) $row2['value'];
            //sumujemy do średniej
        }
        //liczymy średnią
        $ocena_users = $sumaocen / $selocenanum;
     
        $ocena_users_tmp = 0;
        $wartosc1        = $row2['value'];
        (float) $ocena_users_tmp = (float) $ocena_users_tmp + (float) $wartosc1;
        
        $srednia++;
        
        if ($wynik2 <= 0) {
        } else {
            $cos = true;
        }
     
        
        if ($cos != false) {
            //echo ($wynik2);
            //$ocena_users = $ocena_users_tmp/$wynik2;
        } else {
            $ocena_users = "Nikt w Twojej klasie nie oddał jeszcze głosu!";
        }
// wyświeltanie
// GRAMATYKA -------------------------/////////////////////////////
if ($ocena_users == 1)
{
$__gram_gwiazdka = "gwiazdka";
}

if ($ocena_users == 2 || $ocena_users == 3 || $ocena_users == 4 && $ocena_users != 5 && $ocena_users != 1)
{
$__gram_gwiazdka = "gwiazdki";
}

else

{
if ($ocena_users != 1)
{
$__gram_gwiazdka = "gwiazdek";
}
}

if ($ocena_users == 5)
{
$__gram_gwiazdka = "gwiazdek";
}

/////////////////// KONIEC GRAMATYKI ////////////////////////////

$glos_gram = __gram_glos ($wynik2);

 echo ("Średnia ocen zadowolenia uczniów z Twojej klasy:<br /> <b>$ocena_users</b> &nbsp;$__gram_gwiazdka
<br />Liczba głosów:&nbsp;<b>$wynik2</b>&nbsp;$glos_gram<hr />");



// //////////////////----------------KONIEC KODU OCENY ZADOWOLENIA -------//////   


 echo ('<span style="text-decoration: underline">Komentarze do tej wycieczki:</span><br /><br />
 <a id="hrf2" href="trip_comment_add.php?comment=1"><img src="images/comment1.gif"/>&nbsp;Dodaj komentarz!</a><br /><br /><hr />
<b>Wszystkie komentarze:</b><hr color="black" size="1"/>');
  }
//$user_name = cut_string_dot($row['user_name'], 0, 6, 3);
//$answers   = '<a class=info href="#">' . cut_string_dot($row['answers'], 0, 20, 3) . '<span>' . $row['answers'] . '</span></a>';
?></span>
<br />
<div class="dottedline"></div>

 <b><span style="text-decoration: underline"><span style="font-size: 26pt">Uroczystości, wycieczki i wydarzenia klasowe</span></span></b>

<hr COLOR="BLACK" SIZE="1" width="500">
<form action="disco_add.php">  
 <input type="submit" class="button" value="Dodaj informację o uroczystości, dyskotece, innym ważnym klasowym wydarzeniu">
</form>
<hr COLOR="BLACK" SIZE="1" width="500">
		</div>
  <div class="dottedline2"></div><br>
  <center>
      <img src="images/wycieczka1.gif"/>
	</div>
  </center>
</div>	
		<div id="footer"><span style="font-family: Century Gothic;">  <div class="dottedline3"></div>
		 &copy; by Wiktor Jezioro <br><b>Wszelkie prawa zastrzeżone</b><br />
     </span>
      <div class="dottedline3"></div>
      <a id="downbar"  href="regulamin.php">Regulamin</a> &times; <a id="downbar"  href="faq.php">FAQ</a> &times; <a id="downbar"  href="autors.php">Autorzy</a> &times; <a id="downbar"  href="how_run.php">Jak to działa?</a>
	<div class="dottedline3"></div>
  	</div>		</div>
</body></html>

