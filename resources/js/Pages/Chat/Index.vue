<template>

    <div class="chat-app">
        <div class="chat-sidebar">
            <div class="sidebar-header">
                <h3>Чаты</h3>
                <button class="new-chat-btn">+</button>
            </div>

            <div class="chat-search">
                <input type="text" placeholder="Поиск чатов...">
            </div>

            <div v-if="ListChat.length" class="chat-list">
                <div v-for="chat in ListChat" :key="chat.id"
                     class="chat-item"
                     :class="{ active: selectedChat?.id === chat.id }"
                     @click="selectChat(chat)">
                    <div class="chat-name">
                        <input type="hidden" value="{{ chat.id }}">
                        <p>Чат #{{ chat.id }}</p>
                        <p>{{ chat.MasterFirstName }}</p>

                    </div>
                </div>
            </div>
            <div v-else class="no-chats">
                <p>Нет доступных чатов</p>

            </div>
        </div>
        <div class="chat-main">
            <div class="chat-header">
                <h3>Рабочая группа</h3>
                <div class="chat-status">3 участника</div>
            </div>

            <div v-if="Message" class="messages-container">
                <div v-for="Message in Message"  class="message received">
                    <div class="message-sender">{{ Message.user_type === 'client' ? 'Вы' : Message.master_name  }}</div>
                    <div class="message-text">{{ Message.message }}</div>
                    <div class="message-time">{{ Message.created_at }}</div>

                </div>
            </div>

            <div class="message-input">
                <textarea
                    :value="form.message"
                    @input="form.message = $event.target.value"
                    placeholder="Напишите сообщение..."
                    @keyup.enter="sendMessage"
                ></textarea>
                <button @click="sendMessage" class="send-btn">Отправить</button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "Index",

    props: {
        chatId: {
            type: Number,
            required: true
        },
        userType: {
            type: String,
            required: true
        },
        Client_id: {
            type: Number,
            required: true
        },
        masterId: {
            type: Number,
            required: true
        },
        Message: {
            type: Array,
        },
        ListChat: {
            type: Array,
            default: () => []
        },

    },



    data() {
        return {
            form: {
                message: '', // Локальное состояние для сообщения
                Client_id: this.Client_id,
                master_id: null,
                user_type: 'client',
                chat_id: null
            },
            selectedChat: null,

            // formChat:{
            //     Client_id: this.Client_id,
            //     master_id: 52,
            //     chat_id: 2
            // },
        };
    },

    methods: {
        async sendMessage() {
            if (!this.form.message.trim()) return;

            try {
                const response = await axios.post('/MainClient/chat/send', {
                    message: this.form.message,
                    chat_id: this.form.chat_id,
                    user_type: this.form.user_type,
                    master_id: this.form.master_id,
                    client_id: this.Client_id // или this.form.Client_id, в зависимости от того, где хранится ID
                });
                this.$emit('message-sent', response.data);
                this.form.message = '';
            } catch (error) {
                console.error('Ошибка отправки:', {
                    status: error.response?.status,
                    data: error.response?.data,
                    config: error.config
                });

                if (error.response?.status === 405) {
                    alert('Неправильный метод запроса. Обновите страницу.');
                } else {
                    alert('Ошибка отправки: ' + (error.response?.data?.message || error.message));
                }
            }
        },
        selectChat(chat){
            this.selectedChat = chat;
            this.form.chat_id = chat.id;
            this.form.master_id = chat.master_id;

        }
    }
};
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
