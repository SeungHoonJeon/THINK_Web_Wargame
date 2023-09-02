function changeColor(index) {
    var buttons = document.getElementsByClassName('image-button');
    buttons[index].style.backgroundColor = '#f00';
}

function restoreColor(index) {
    var buttons = document.getElementsByClassName('image-button');
    buttons[index].style.backgroundColor = '#ccc';
}

function clickbt(index){
    var xmlHttp = new XMLHttpRequest()
    console.log(1)
    xmlHttp.onreadystatechange = function () {
      if (this.status == 200 && this.readyState == this.DONE) {
        console.log(xmlHttp.responseText)
      }
    }

    xmlHttp.open('GET', './download.php?idx='+index, true)
    xmlHttp.send()
}
