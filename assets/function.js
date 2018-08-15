    function nosamb() {
        var checkBox = document.getElementById("cekNosamb");
        var text = document.getElementById("textNosamb");
        if (checkBox.checked == true){
            text.style.display = "block";
        } else {
           text.style.display = "none";
        }
    }

    function tagihan() {
        var checkBox = document.getElementById("cekTag");
        var text = document.getElementById("textTag");
        if (checkBox.checked == true){
            text.style.display = "block";
        } else {
           text.style.display = "none";
        }
    }




