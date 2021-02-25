@extends('layouts.dash')
    @section('content')
    
    <div class="container-fluid">
        <h1 class="mt-4">Partager mon Lien</h1>

        <p>
            Partagez votre liens d'inscription à une connaissace via WhatsApp et bénéficiez automatiquement d'une commission dans votre Porte Monaie Money Maker
        </p>
        <div class="row">
            <div class="col-md-6">
                <input type="text" id="copyTarget"  class="form-control" value="www.moneymaker-cmr.com/register/?refere_par={{Auth::user()->no_compte_carte_virtuelle}}"><br>
                <a href="https://api.whatsapp.com/send?text=www.moneymaker-cmr.com/?refere_par={{Auth::user()->no_compte_carte_virtuelle}}" type="submit" class="col-md-4 btn btn-warning" name="share" >Partager</a>
                <button id="copyButton"  class="col-md-4 btn btn-secondary">Copier</button><br><br>
            </div>
            <div class="col-md-6">
                <img src="/complement/assets/img/share.png" style="width: 100%">
            </div>
        </div>
        
<script>
    document.getElementById("copyButton").addEventListener("click", function() {
    copyToClipboard(document.getElementById("copyTarget"));
});

function copyToClipboard(elem) {
	  // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
    	  succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}
</script>
    @endsection