<table width=100%>
<tr><th colspan=4><font color='red'> Bienvenue dans l'administration de l'ENSA Khouribga</font></th>
<th rowspan=2>
<div id="horloge"></div>
        <script>
        var dateActuelle = new Date();
        var horloge = document.getElementById("horloge");
        function incrementer2()
                {
                dateActuelle.setTime(dateActuelle.getTime()+1000);
                horloge.innerHTML = "<font size='-1'> "+dateActuelle.getDate()+"/"+(dateActuelle.getMonth()+1)+"/"+dateActuelle.getFullYear()+".<br>Il est : "+dateActuelle.getHours()+":"+dateActuelle.getMinutes()+":"+dateActuelle.getSeconds()+"</font>";
                setTimeout(incrementer2, 1000);
                }
        onload = incrementer2;
	</script>
</th></tr>
<tr><th><a href='acceuil_admin.php'>ADMINISTRATION</a></th><th><a  href='indexInfo.php'>INFORMATION</a></th><th><a href='indexAjout.php'>AJOUT</a></th><th><a href='indexmessage.php'>MESSAGES</a></th>
</tr>
</table>