$(document).ready(function() {
   $('#uu').keyup(function(){
       alert($(this).val());
       $(this).submit();
   });
});

function functie(val)
{
/*    alert("test");
    if(val.length == 0)
    {
        document.getElementsById("uur").innerHTML="";
        return;
    }
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("txtMonteurs").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","get_monteurs.php?u="+str,true);
    xmlhttp.send();*/
}