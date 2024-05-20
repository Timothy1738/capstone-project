document.addEventListener('DOMContentLoaded', function() {
    const notifications = document.querySelector('.notifications');
    const notificationsBox = document.querySelector('.notifications-box');
    const closeIcons = document.querySelectorAll('.close-icon');
    const markAllAsRead = document.getElementById('markAllAsRead');

    // Toggle notifications box visibility
    notifications.addEventListener('click', function(event) {
        event.stopPropagation();
        notificationsBox.style.display = notificationsBox.style.display === 'block' ? 'none' : 'block';
    });

    // Close notifications box when clicking outside of it
    document.addEventListener('click', function() {
        notificationsBox.style.display = 'none';
    });

    // Prevent closing when clicking inside the notifications box
    notificationsBox.addEventListener('click', function(event) {
        event.stopPropagation();
    });

    // Mark individual notification as read
    closeIcons.forEach(icon => {
        icon.addEventListener('click', function(event) {
            event.stopPropagation();
            const notification = this.closest('.notify');
            const notificationId = notification.getAttribute('data-id');
            notification.remove();
            markNotificationAsRead(notificationId);
        });
    });

    // Mark all notifications as read
    // markAllAsRead.addEventListener('click', function() {
    //     document.querySelectorAll('.notify').forEach(notification => {
    //         const notificationId = notification.getAttribute('data-id');
    //         notification.remove();
    //         markNotificationAsRead(notificationId);
    //     });
    // });

    // // Function to mark a notification as read
    // function markNotificationAsRead(notificationId) {
    //     // AJAX request to mark notification as read in the database
    //     const xhr = new XMLHttpRequest();
    //     xhr.open('POST', '../backend/mark_notification_read.php', true);
    //     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    //     xhr.onreadystatechange = function() {
    //         if (xhr.readyState === 4 && xhr.status === 200) {
    //             console.log('Notification marked as read:', notificationId);
    //         }
    //     };
    //     xhr.send('notification_id=' + notificationId);
    // }
});