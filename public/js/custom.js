$(document).ready(function(){
    var serverCard = $('.shift-server-card');
    serverCard.click(function() {
        var serverId = this.id.split('-')[1];
        window.location.href = '/servers/' + serverId;
    });
});
