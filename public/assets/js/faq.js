$(document).ready(function() {
    
    const displayDuration = 5000; 

    const notification = $('#notification');

    if (notification.length > 0) {
        notification.show();

        setTimeout(function() {
            notification.hide();
        }, displayDuration);
    }
});