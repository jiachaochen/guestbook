//Post comment to server and get result back and update page

function postComment(){

  var name = document.getElementById("name").value;
  var comment = document.getElementById("comment").value;
  //Get current time
  var currentDate = new Date();
  var year = currentDate.getFullYear();
  var month = currentDate.getMonth();
  var day = currentDate.getDate();
  var hour = currentDate.getHours();
  var minute = currentDate.getMinutes();
  var posttime = year+"-"+month+"-"+day+" "+hour+":"+minute;

  var xmlHttpRequest = new XMLHttpRequest();
  xmlHttpRequest.onreadystatechange = function() {
    if (xmlHttpRequest.readyState == 4 && xmlHttpRequest.status == 200){
        if (xmlHttpRequest.responseText == "success"){
          //Empty fields
          document.getElementById("name").value = "";
          document.getElementById("comment").value = "";
          //create element to be appended.
          var div1Element = document.createElement("div");
          div1Element.setAttribute("class","col-sm-1");
          var div11Element = document.createElement("div");
          div11Element.setAttribute("class","col-sm-11");
          var h4Element = document.createElement("h4");
          var h4TextNode = document.createTextNode(name);
          h4Element.appendChild(h4TextNode);
          var smallElement = document.createElement("small");
          var smallTextNode = document.createTextNode(" "+posttime);
          smallElement.appendChild(smallTextNode);
          h4Element.appendChild(smallElement);
          div11Element.appendChild(h4Element);
          var pElement = document.createElement("p");
          var pTextNode = document.createTextNode(comment);
          pElement.appendChild(pTextNode);
          div11Element.appendChild(pElement);
          var content = document.getElementById("content");
          content.appendChild(div1Element);
          content.appendChild(div11Element);
          getNumOfComments();
        }else{
        }
    }
  }
  xmlHttpRequest.open("GET","addComment.php?name="+name+"&comment="+comment+"&posttime="+posttime, true);
  xmlHttpRequest.send();
}

function getNumOfComments(){
  var xmlHttpRequest = new XMLHttpRequest();
  xmlHttpRequest.onreadystatechange = function(){
    if(xmlHttpRequest.readyState == 4 && xmlHttpRequest.status == 200){
      if (xmlHttpRequest.responseText != "failed") {
        var spanElement = document.getElementById("numOfComments");
        spanElement.innerHTML = xmlHttpRequest.responseText;
      }
    }
  }
  xmlHttpRequest.open("GET","countComments.php",true);
  xmlHttpRequest.send();
}
