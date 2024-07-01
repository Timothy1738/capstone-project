document.addEventListener('DOMContentLoaded', function () {
    const notifications = document.querySelector('.notifications');
    const notificationsBox = document.querySelector('.notifications-box');
    const closeIcons = document.querySelectorAll('.close-icon');
    const markAllAsRead = document.getElementById('markAllAsRead');

    // Toggle notifications box visibility
    notifications.addEventListener('click', function (event) {
        event.stopPropagation();
        notificationsBox.style.display = notificationsBox.style.display === 'block' ? 'none' : 'block';
    });

    // Close notifications box when clicking outside of it
    document.addEventListener('click', function () {
        notificationsBox.style.display = 'none';
    });

    // Prevent closing when clicking inside the notifications box
    notificationsBox.addEventListener('click', function (event) {
        event.stopPropagation();
    });

    // Mark individual notification as read
    closeIcons.forEach(icon => {
        icon.addEventListener('click', function (event) {
            event.stopPropagation();
            const notification = this.closest('.notify');
            const notificationId = notification.getAttribute('data-id');
            notification.remove();
            markNotificationAsRead(notificationId);
            console.log(notificationId);
        });
    });

    // Mark all notifications as read
    markAllAsRead.addEventListener('click', function () {
        document.querySelectorAll('.notify').forEach(notification => {
            const notificationId = notification.getAttribute('data-id');
            // console.log(notificationId);
            notification.remove();
            markNotificationAsRead(notificationId);
        });
    });

    // Function to mark a notification as read
    function markNotificationAsRead(notificationId) {
        // AJAX request to mark notification as read in the database
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'mark_notification_read.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log('Notification marked as read:', notificationId);
            }
        };
        xhr.send('notification_id=' + notificationId);
    }
});

// document.addEventListener('DOMContentLoaded', function() {
//     const notificationsBox = document.querySelector('.notifications-box');
//     const closeIcons = document.querySelectorAll('.close-icon');
//     const markAllAsRead = document.getElementById('markAllAsRead');

//     // Toggle notifications box visibility
//     notificationsBox.addEventListener('click', function(event) {
//         event.stopPropagation();
//         notificationsBox.style.display = notificationsBox.style.display === 'block' ? 'none' : 'block';
//     });

//     // Close notifications box when clicking outside of it
//     document.addEventListener('click', function() {
//         notificationsBox.style.display = 'none';
//     });

//     // Prevent closing when clicking inside the notifications box
//     notificationsBox.addEventListener('click', function(event) {
//         event.stopPropagation();
//     });

//     // Mark individual notification as read
//     closeIcons.forEach(icon => {
//         icon.addEventListener('click', function(event) {
//             event.stopPropagation();
//             const notification = this.closest('.notify');
//             const notificationId = notification.getAttribute('data-id');
//             notification.remove();
//             markNotificationAsRead(notificationId);
//             console.log(notificationId);
//         });
//     });

//     // Mark all notifications as read
//     markAllAsRead.addEventListener('click', function() {
//         document.querySelectorAll('.notify').forEach(notification => {
//             const notificationId = notification.getAttribute('data-id');
//             notification.remove();
//             markNotificationAsRead(notificationId);
//         });
//     });

//     // Function to mark a notification as read
//     function markNotificationAsRead(notificationId) {
//         // AJAX request to mark notification as read in the database
//         const xhr = new XMLHttpRequest();
//         xhr.open('POST', '../backend/mark_notification_read.php', true);
//         xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//         xhr.onreadystatechange = function() {
//             if (xhr.readyState === 4 && xhr.status === 200) {
//                 console.log('Notification marked as read:', notificationId);
//             }
//         };
//         xhr.send('notification_id=' + notificationId);
//     }
// });


document.addEventListener('DOMContentLoaded', (event) => {
    var icon = document.querySelector("#theme img");
    icon.onclick = function () {
        console.log("clicked");
        document.body.classList.toggle("light-theme-variables");
        if (document.body.classList.contains("light-theme-variables")) {
            icon.src = "../images/dark theme icon/moon.png";
        } else {
            icon.src = "../images/dark theme icon/sun.png";
        }
    };
});

// Function to open the modal
function openModal() {
    const modal = document.getElementById('myModal');
    modal.style.display = 'block';
}

// Function to close the modal
function closeModal() {
    const modal = document.getElementById('myModal');
    modal.style.display = 'none';
}

// Event listener to open the modal when the button is clicked
document.querySelectorAll('.visible').forEach(button => {
    button.addEventListener('click', function () {
        openModal();
    });
});

// Event listener to close the modal when the close button is clicked
document.querySelector('.modal .close').addEventListener('click', function () {
    closeModal();
});


