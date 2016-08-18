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
	<meta charset="utf-8"><title>Dzienniczek ucznia online - Strefa ucznia - Zadania domowe</title>
  <script type="text/javascript">
    // <![CDATA[
      function searchSuggest(){
var str = escape(document.getElementById('searchinput').value);
var myAjax = new Ajax.Request(
      'suggest.php',
      {
         method: 'get',
         parameters: "search="+str,
         onComplete: showResponse,
         onFailure: showAlert
      });
               
}
function showResponse(text){
       
        var search_suggest = document.getElementById("search_suggest");
        search_suggest.style.visibility = "visible";
        var ss = document.getElementById('search_suggest')
        ss.innerHTML = '';
        var str = text.responseText.split("\n");
        for(i=0; i < str.length - 1; i++)
        { var suggest = '<div onmouseover="javascript:suggestOver(this);" ';
                        suggest += 'onmouseout="javascript:suggestOut(this);" ';
                        suggest += 'onclick="javascript:setSearch(this.innerHTML);" ';
                        suggest += 'class="suggest_link">' + str[i] + '</div>';
                        ss.innerHTML += suggest;
                }
       
       
       
}
function showAlert(MyRequest) {
        alert("Operacja nie powiodła się");
}
function suggestOver(div_value) {
       
        div_value.className = 'suggest_link_over';
}
function suggestOut(div_value) {
       
        div_value.className = 'suggest_link';
}
function setSearch(value) {
        var search_suggest = document.getElementById("search_suggest");
        search_suggest.style.visibility = "hidden";
        document.getElementById('searchinput').value = value;
        document.getElementById('search_suggest').innerHTML = '';
}
    // ]]>
  </script>
	<meta name="description" content="Dzienniczek ucznia online - Ocenownik">
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
			<span class="bigtitle">Strefa ucznia</span></div>
			<div class="dottedline"></div>
      	<div style="font-family: Century Gothic;" id="menu2">
    <b> <center> <div class="option2"><a href="homeworks.php">Zadania domowe</a></div>
			<div class="option2"><a href="write_works.php">Prace pisemne</a></div>
      <div class="option2"><a href="answer.php">Odpowiedź ustna</a></div>
			<div class="option2"><a href="notes.php">Oceny</a></div>
      	<div  class="option2"><a href="other_school.php">Pozostałe szkolne</a></div></b>
			<div  style="clear: both;"></div></center>
		</div>
<div style="text-align: center;">
<div class="dottedline"></div>
<div style="text-align: center; text-decoration: underline;">
			<span class="bigtitle">Dodaj nowe zadanie domowe do bazy</span></div>
<br />
 
<center>
<?php
$pop_file  = true;
$pop_topic = true;
session_start();
include 'config.php';
db_connect();
$user = $_SESSION['userek'];

if ($_POST['not_empty'] == "tak") {
    
    if ($_POST['opc_1'] == "a") {
        
        if (is_uploaded_file($_FILES['plik']['tmp_name'])) {
            $file_is_uploaded = 1;
           if(strtolower(end(explode('.',$_FILES['plik']['name'])))!='jpg')  
           {  
             $pop_file = false;  
             echo '<div style="font-family: Century Gothic;" id="topbar14">
				<div style="text-align: center;">
				<span class="bigtitle3"><b>BŁĄD</b><br />Wykryto próbę ataku na serwer!<br /><span style="text-decoration: underline">Twój adres IP został zapisany w bazie danych!</span></span></div>
		</div>'; 
           }        

        } else {
            echo '<div style="font-family: Century Gothic;" id="topbar14">
				<div style="text-align: center;">
				<span class="bigtitle3"><b>BŁĄD</b><br />Rozmiar pliku skanu nie może przekraczać 15 MB!<br />Lub plik nie został załadowany</span></div>
		</div>';
            $pop_file = false;
        }
        
    }
    if ($_POST['topic'] == "") {
        echo '<div style="font-family: Century Gothic;" id="topbar15">
				<div style="text-align: center;">
				<span class="bigtitle3"><b>BŁĄD</b><br />Pole na temat zadania nie może być puste!</span></div>
		</div>';
        $pop_topic = false;
    }
    
    if ($_POST['topic'] == "") {
        echo '<div style="font-family: Century Gothic;" id="topbar15">
				<div style="text-align: center;">
				<span class="bigtitle3"><b>BŁĄD</b><br />Pole na temat zadania nie może być puste!</span></div>
		</div>';
        $pop_topic = false;
    }
    
    if ($pop_topic != false && $pop_file != false) {
        $plik_tmp     = $_FILES['plik']['tmp_name'];
        $plik_nazwa   = $_FILES['plik']['name'];
        $plik_rozmiar = $_FILES['plik']['size'];
        
        if (is_uploaded_file($plik_tmp)) {
            move_uploaded_file($plik_tmp, "upload_files/$user/scans/$plik_nazwa");
        }
        // deklaracja nazwy usera
        
        
        // odczyt konfiguracji z bazy MySql
        //select average_plus FROM `account_config` WHERE `user`='lakewik';
        
        $zapytanie = mysql_query("select * FROM `account_config` WHERE `user`='$user'");
        $row       = mysql_fetch_assoc($zapytanie);
        
        $plus_value  = $row['average_plus'];
        $minus_value = $row['average_minus'];
        
        
        //$plus_value = mysql_query("select average_plus FROM `account_config` WHERE `user`='lakewik'");
        //$minus_value = mysql_query("select average_minus FROM `account_config` WHERE `user`='$user'");
        
        if ($_POST['sign'] == "+") {
            $wartosc_oceny = $_POST['note'] + $plus_value;
        }
        
        if ($_POST['sign'] == "-") {
            $wartosc_oceny = $_POST['note'] - $plus_value;
        }
        
        if ($_POST['sign'] == "0") {
            $wartosc_oceny = $_POST['note'];
        }
        $topic       = $_POST['topic'];
        $answers     = $_POST['answers'];
        $description = $_POST['description'];
        $przedmiot   = $_POST['object'];
        $nauczyciel  = $_POST['profesor'];
        if ($_POST['sign'] != "0") {
            $note = $_POST['sign'] . $_POST['note'];
        } else {
            $note = $_POST['note'];
        }
        
        if ($_POST['opc_1'] == "a") {
            
            if ($file_is_uploaded == 1) {
                $scan = "$plik_nazwa";
            } else {
                $scan = "brak";
            }
        } else {
            $scan = "brak";
        }
        
        mysql_query("INSERT INTO `homeworks` (
    `user_name` ,
    `scan` ,
    `note` ,
    `add_date`,
    `profesor`,
    `object`,
    `answers`,
    `topic`,
    `description`,
    `note_value`
    )
    VALUES (
    '$user', '$scan', '$note', NOW(), '$nauczyciel','$przedmiot','$answers','$topic','$description','$wartosc_oceny'
    );");
echo ('<div style="font-family: Century Gothic;" id="topbar11">
				<div style="text-align: center;">
				<span class="bigtitle3"><b><span style="text-decoration: underline">Zadanie domowe zostało pomyślnie dodane do bazy danych!</span></b><br /><br /><form  action="homeworks.php">
<input value="Przejdź do listy zadań domowych" type="submit">
  </form></span></div><br />
		</div><br />');

}
}
?>    
<form action="homework_add.php" method="post" ENCTYPE="multipart/form-data" name="form1">
  <input type="hidden" name="not_empty" value="tak" />
  <b><span style="color: #FF0000">*</span>Ocena: </b>
  <select class="button2" name="sign">
      <option value="+">+</option>
      <option value="0"> </option>
      <option value="-">-</option>
      </select>
  
  <select class="button2" name="note">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      </select>
  <br />
    <br />
   <b>Nauczyciel: </b>
   <input class="button3" list="imiona" name="profesor">
    <datalist id="imiona">
    <option value="Ania">
    <option value="Andrzej">
    <option value="Aleksander">
    <option value="Alfons">
    </datalist>
    <br />
    <br />
   <b><span style="color: #FF0000">*</span>Temat: </b><input class="button3" name="topic" type="text"  size="20" maxlength="40" />
   <br />
    <br />
    <b>Odpowiedzi: </b> <br /> <textarea class="button3" name="answers" rows="5" cols="39" ></textarea>
 <br />
    <br />
    <b>Opis: </b> <br /> <textarea class="button3" name="description" rows="5" cols="39" ></textarea>
 <br />
    <br />
   <script type="text/javascript">
    function on(i) {
      if (document.form1.opc_1.checked == true) {
                        i.userfile.disabled = false;
                }else{
                        i.userfile.disabled = true;
}
    }
    </script>
  <input  name="opc_1" onclick="on(this.form)" type="checkbox" value="a" id="blok"/>
  Zapisz skan zadania w bazie danych:
  <br />
  <br />
  <input type="hidden" name="MAX_FILE_SIZE" value="1000000000000000" />
  <input type="file" id="userfile" class="button2" name="plik" disabled="disabled"  accept="image/jpeg,image/gif">
  <br /><span style="font-size: 11pt; color: #FF0000">Rozmiar pliku nie może przekraczać 15 MB!</span>
  <br />
    <br />
    <b><span style="color: #FF0000">*</span>Przedmiot: </b>
  <select class="button2" name="object">
     <optgroup label="Ścisłe">
	<option value="Chemia">Chemia</option>
	<option value="Matematyka">Matematyka</option>
</optgroup>
<optgroup label="Humanistyczne">
	<option value="Język Polski">Język Polski</option>
	<option value="Język Niemiecki">Język Niemiecki</option>
  <option value="Język Angielski">Język Angielski</option>
</optgroup>
      </select>
     <br />
    <br />
 <input type="submit" class="button" value="Dodaj zadanie domowe!">
</form>


</center>
    
  </big>
	</div>
	<div class="dottedline"></div>
  <div style="text-align: center; ">
  
<b><span style="text-decoration: underline"><span style="font-size: 26pt"></span>Wykaz zadań domowych</span></b>
<br />
<br />
<form action="homeworksphp">  
 <input type="submit" class="button" value="Przejdź do wykazu zadań domowych">
</form>
		</div>
  <div class="dottedline2"></div><br>
  <center>
  <img src="images/spr1.gif" width="400"/>
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
