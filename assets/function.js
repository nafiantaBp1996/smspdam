    function nosamb() {
        var checkBox = document.getElementById("cekNosamb");
        var text = document.getElementById("textNosamb");
        if (checkBox.checked == true){
            text.disabled=false;
        } else {
           text.disabled=true;
        }
    }

    function tagihan() {
        var checkBox = document.getElementById("cekTag");
        var text = document.getElementById("textTag");
        var textmax = document.getElementById("textTagMax");
        if (checkBox.checked == true){
            text.disabled=false;
            textmax.disabled=false;
        } else {
            text.disabled=true;
            textmax.disabled=true; 
        }
    }

    function total() {
        var cb = document.getElementById("cekTot");
        var te = document.getElementById("textTotmin");
        var tm = document.getElementById("textTotmax");
        if (cb.checked == true) {
            te.disabled=false;
            tm.disabled=false;
        } else {
            te.disabled=true;
            tm.disabled=true;
        }
    }

    function rayon() {
        var cb = document.getElementById("cekRayon");
        var te = document.getElementById("selRayon");
        if (cb.checked == true) {
            te.disabled=false;
        } else {
            te.disabled=true;
        }
    }
    function kelurahan() {
        var cb = document.getElementById("cekKelurahan");
        var te = document.getElementById("selKelurahan");
        if (cb.checked == true) {
            te.disabled=false;
        } else {
            te.disabled=true;
        }
    }

    function golongan() {
        var cb = document.getElementById("cekGolongan");
        var te = document.getElementById("selGolongan");
        if (cb.checked == true) {
            te.disabled=false;
        } else {
            te.disabled=true;
        }
    }