<?php
include "./includes/header.php";
?>


<div class="events_splash">
    <h1>My Messages</h1>
    <!--  -->
</div>
<!-- end of events splash -->

<div class="chat container">
    <h3>Send anyone a message 😊✌️🫂🤝</h3>
    <div class="chat-box">
        <div class="chat-list">
            <div class="search-tab">
                <input type="text" id="searchInput" placeholder="Search...">
            </div>
            <div class="current-chats" id="currentChats">
                <!-- This will display current chats -->
            </div>
            <div class="message-list" id="messageList" style="display: none;">
                <!-- This will display search results -->
            </div>
        </div>
        <div class="chat-interface">
            <div class="header" id="header">
                <p>Select a chat to get started</p>
            </div>

            <div class="conversation" id="conversation">
                <!-- Display conversation history -->

            </div>

            <form action="" id="sendMessageForm">
                <input type="text" id="messageInput" placeholder="Type a message...">
                <button><iconify-icon icon="streamline:mail-send-email-message"></iconify-icon></button>
            </form>
        </div>
    </div>
</div>
</div>

<?php include "./includes/footer.php"; ?>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // Debounce function to limit the rate at which a function can fire.
        function debounce(func, wait) {
            let timeout;
            return function() {
                const context = this,
                    args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), wait);
            };
        }

        // Search users
        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', debounce(searchUsers, 300));

        function searchUsers() {
            const query = document.getElementById('searchInput').value.trim();

            if (query === '') {
                document.getElementById('currentChats').style.display = 'block';
                document.getElementById('messageList').style.display = 'none';
                loadCurrentChats();
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.open('GET', `search_users.php?query=${encodeURIComponent(query)}`, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        try {
                            const users = JSON.parse(xhr.responseText);
                            document.getElementById('currentChats').style.display = 'none';
                            document.getElementById('messageList').style.display = 'block';
                            updateMessageList(users);
                        } catch (e) {
                            console.error('Error parsing JSON response:', e);
                            console.log('Response received:', xhr.responseText);
                        }
                    } else {
                        console.error('Error in AJAX request:', xhr.statusText);
                    }
                }
            };
            xhr.send();
        }

        function updateMessageList(users) {
            const messageList = document.getElementById('messageList');
            messageList.innerHTML = '';
            users.forEach(user => {
                const contactDiv = document.createElement('div');
                contactDiv.className = 'contact';
                contactDiv.onclick = function() {
                    openChat(user.user_id);
                };
                contactDiv.innerHTML = `
                <div class="img">
                    <img src="../dbimages/${user.profile_picture}" alt="">
                </div>
                <p>${user.name}</p>
            `;
                messageList.appendChild(contactDiv);
            });
        }

        // Load current chats
        loadCurrentChats();

        function loadCurrentChats() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_current_chats.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const chats = JSON.parse(xhr.responseText);
                    updateCurrentChats(chats);
                }
            };
            xhr.send();
        }

        function updateCurrentChats(chats) {
            const currentChats = document.getElementById('currentChats');
            currentChats.innerHTML = '';

            if (chats.length === 0) {
                currentChats.innerHTML = '<p style="padding: 10px; width: 100%; border-radius: 5px; margin-top: 20px; color: white; background: var(--about-bg);">Start messaging now...</p>';
                return;
            }

            chats.forEach(chat => {
                const contactDiv = document.createElement('div');
                contactDiv.className = 'contact';
                contactDiv.setAttribute('data-contact-id', chat.user_id);
                contactDiv.innerHTML = `
                <div class="img">
                    <img src="../dbimages/${chat.profile_picture}" alt="">
                </div>
                <p>${chat.name}</p>
                
            `;
                contactDiv.addEventListener('click', function() {
                    openChat(chat.user_id);
                });
                currentChats.appendChild(contactDiv);
            });
        }

        function openChat(contactId) {
            fetchContactDetails(contactId);
            fetchChatHistory(contactId);
            currentContactId = contactId; // Store the current contact ID for sending messages
        }

        // Handle the form submission for sending a message
        const sendMessageForm = document.getElementById('sendMessageForm');
        sendMessageForm.addEventListener('submit', function(event) {
            event.preventDefault();
            sendMessage();
        });

        let currentContactId = null; // Variable to store the current contact ID

        function sendMessage() {
            const messageInput = document.getElementById('messageInput');
            const messageContent = messageInput.value.trim();

            if (messageContent === '' || !currentContactId) {
                return; // Do nothing if the message is empty or no contact is selected
            }

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'send_message.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        fetchChatHistory(currentContactId); // Refresh the chat history
                        messageInput.value = ''; // Clear the input field
                    } else {
                        console.error('Error sending message:', response.error);
                    }
                }
            };
            xhr.send(`contact_id=${currentContactId}&message=${encodeURIComponent(messageContent)}`);
        }

        function fetchContactDetails(contactId) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `get_contact_details.php?contact_id=${contactId}`, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText); // Log the response text to the console
                        try {
                            const contact = JSON.parse(xhr.responseText);
                            const currentContact = document.getElementById('header');
                            currentContact.innerHTML = `
                            <span id="currentContact">
                                <div class="img">
                                    <a href="view-other-profile.php?id=${contact.user_id}">
                                        <img src="../dbimages/${contact.profile_picture}" alt="">
                                    </a>
                                </div>
                                <p>${contact.name}</p>
                            </span>
                            <div class="delete">
                                <iconify-icon icon="fluent:delete-32-regular"></iconify-icon>
                            </div>
                        `;
                            // Add event listener for the delete button
                            const deleteButton = currentContact.querySelector('.delete');
                            deleteButton.addEventListener('click', function() {
                                if (confirm("Are you sure you want to delete this chat?")) {
                                    deleteChat(contact.user_id);
                                }
                            });
                        } catch (e) {
                            console.error('Error parsing JSON response:', e);
                            console.log('Response received:', xhr.responseText);
                        }
                    } else {
                        console.error('Error in AJAX request:', xhr.statusText);
                    }
                }
            };
            xhr.send();
        }

        function fetchChatHistory(contactId) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `get_chat_history.php?contact_id=${contactId}`, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const messages = JSON.parse(xhr.responseText);
                    updateConversation(messages);
                }
            };
            xhr.send();
        }

        function updateConversation(messages) {
            const conversation = document.getElementById('conversation');
            conversation.innerHTML = '';
            messages.forEach(message => {
                const messageDiv = document.createElement('div');
                const isDeleted = message.delete_status !== 'valid';
                messageDiv.className = isDeleted ? 'message-deleted' : (message.sender === 'you' ? 'you-message' : 'other-message');
                const senderLink = message.sender === 'you' ? 'You' : `<a href="view-other-profile.php?id=${message.sender_id}">${message.sender_name}</a>`;
                const messageContent = isDeleted ? '[message deleted]' : message.message;
                const deleteIcon = message.sender === 'you' && !isDeleted ? `<div class="delete" onclick="deleteMessage(${message.message_id})"><iconify-icon icon="fluent:delete-32-regular"></iconify-icon></div>` : '';
                messageDiv.innerHTML = `
            <div class="profile">
                ${senderLink}
            </div>
            <p>${messageContent}</p>
            <div class="time-stamp">
                ${message.sent_at}
                ${deleteIcon}
            </div>`;
                conversation.appendChild(messageDiv);
            });
        }

        window.deleteMessage = function(messageId) {
            if (confirm("Are you sure you want to delete this message?")) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'delete_message.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            const response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                // If deletion was successful, remove the message from the conversation
                                const messageDiv = document.getElementById(`message_${messageId}`);
                                if (messageDiv) {
                                    messageDiv.remove();
                                }
                            } else {
                                console.error('Failed to delete message:', response.message);
                            }
                        } else {
                            console.error('Error in AJAX request:', xhr.statusText);
                        }
                    }
                };
                xhr.send(`message_id=${messageId}`);
            }
        };

        function deleteChat(contactId) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'delete_chat.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            // If deletion was successful, reload the current chats
                            loadCurrentChats();
                            // Clear the chat history display
                            document.getElementById('conversation').innerHTML = '';
                            document.getElementById('header').innerHTML = '';
                        } else {
                            console.error('Failed to delete chat:', response.message);
                        }
                    } else {
                        console.error('Error in AJAX request:', xhr.statusText);
                    }
                }
            };
            xhr.send(`contact_id=${contactId}`);
        }

    });
</script>