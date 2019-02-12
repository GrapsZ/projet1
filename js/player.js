
function onClickChange(idMu,idUs) {
    document.getElementById("contentcoeur").innerHTML = "<b>Vous aimez cette chanson:</b> <i class='far fa-heart coeurliked'></i>";

    var likes = "idMu=" + idMu +  "&idUs=" + idUs + "&action=like";

    req = new XMLHttpRequest();
    req.open('POST', 'likeme.php', true);
    req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    req.onload = function() {
        if (req.status !== 200) {
            alert('Erreur num : ' + req.status);
        }
    };
    req.send(likes);
};

function onClickDislike(idMu,idUs) {
    document.getElementById("contentcoeur").innerHTML = "<b>Aimer cette chanson:</b> <i class='far fa-heart coeurlike'></i>";

    var dislikes = "idMu=" + idMu +  "&idUs=" + idUs + "&action=dislike";

    req = new XMLHttpRequest();
    req.open('POST', 'likeme.php', true);
    req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    req.onload = function() {
        if (req.status !== 200) {
            alert('Erreur num : ' + req.status);
        }
    };
    req.send(dislikes);
};