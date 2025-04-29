<template>
    <div class="chat-app">
        <!-- Боковая панель с чатами -->
        <div class="chat-sidebar">
            <div class="sidebar-header">
                <h3>Чаты</h3>
                <button class="new-chat-btn">+</button>
            </div>

            <div class="chat-search">
                <input type="text" placeholder="Поиск чатов...">
            </div>

            <div class="chat-list">
                <div class="chat-item active">
                    <div class="chat-name">Иван Петров</div>
                    <div class="chat-preview">Договорились на встречу</div>
                    <div class="chat-time">10:15</div>
                </div>


                <div class="chat-item">
                    <div class="chat-name">Ольга Сидорова</div>
                    <div class="chat-preview">Отправила документы</div>
                    <div class="chat-time">Вчера</div>
                </div>
            </div>
        </div>

        <!-- Основное окно переписки -->
        <div class="chat-main">
            <div class="chat-header">
                <h3>Рабочая группа</h3>
                <div class="chat-status">3 участника</div>
            </div>

            <div class="messages-container">
                <div class="message received">
                    <div class="message-sender">Иван Петров</div>
                    <div class="message-text">Привет, как продвигается проект?</div>
                    <div class="message-time">12:30</div>
                </div>

            </div>

            <div class="message-input">
                <textarea placeholder="Напишите сообщение..."></textarea>
                <button class="send-btn">Отправить</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Index"
}
</script>

<style scoped>


  .chat-app {
      display: flex;
      height: 100vh;
      font-family: Arial, sans-serif;
  }

/* Стили для боковой панели */
.chat-sidebar {
    width: 300px;
    background: #f5f5f5;
    border-right: 1px solid #ddd;
    display: flex;
    flex-direction: column;
}

.sidebar-header {
    padding: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #ddd;
}

.new-chat-btn {
    background: #4CAF50;
    color: white;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    font-size: 16px;
    cursor: pointer;
}

.chat-search {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.chat-search input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.chat-list {
    flex-grow: 1;
    overflow-y: auto;
}

.chat-item {
    padding: 12px;
    border-bottom: 1px solid #eee;
    cursor: pointer;
}

.chat-item:hover {
    background: #ebebeb;
}

.chat-item.active {
    background: #e0e0e0;
}

.chat-name {
    font-weight: bold;
    margin-bottom: 4px;
}

.chat-preview {
    font-size: 0.9em;
    color: #666;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.chat-time {
    font-size: 0.8em;
    color: #999;
    margin-top: 4px;
}

/* Стили для основного окна чата */
.chat-main {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.chat-header {
    padding: 15px;
    border-bottom: 1px solid #ddd;
}

.chat-status {
    font-size: 0.9em;
    color: #666;
}

.messages-container {
    flex-grow: 1;
    padding: 15px;
    overflow-y: auto;
    background: #fafafa;
}

.message {
    margin-bottom: 15px;
    max-width: 70%;
}

.message.received {
    margin-right: auto;
}

.message.sent {
    margin-left: auto;
    text-align: right;
}

.message-sender {
    font-weight: bold;
    margin-bottom: 4px;
    color: #333;
}

.message-text {
    background: white;
    padding: 10px 15px;
    border-radius: 18px;
    display: inline-block;
    box-shadow: 0 1px 2px rgba(0,0,0,0.1);
}

.message.sent .message-text {
    background: #dcf8c6;
}

.message-time {
    font-size: 0.8em;
    color: #999;
    margin-top: 4px;
}

.message-input {
    padding: 15px;
    border-top: 1px solid #ddd;
    display: flex;
    align-items: flex-end;
}

.message-input textarea {
    flex-grow: 1;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    resize: none;
    min-height: 50px;
    max-height: 150px;
}

.send-btn {
    margin-left: 10px;
    padding: 10px 20px;
    background: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

</style>
