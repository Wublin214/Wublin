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
            <!-- Блок для клиентов -->
            <template v-if="Auth === 'client'">
                <div v-if="ListChat.length" class="chat-list">
                    <div
                        v-for="chat in ListChat"
                        :key="chat.id"
                        class="chat-item"
                        :class="{ active: selectedChat?.id === chat.id }"
                        @click="selectChat(chat)"
                    >
                        <div class="chat-name">
                            <p>Чат #{{ chat.id }}</p>
                            <p>{{ chat.MasterFirstName }}</p>
                        </div>
                    </div>
                </div>
                <div v-else class="no-chats">
                    <p>Нет доступных чатов</p>
                </div>
            </template>

            <!-- Блок для мастеров -->
            <template v-else-if="Auth === 'master'">
                <div v-if="ListChat.length" class="chat-list">
                    <div
                        v-for="chat in ListChat"
                        :key="chat.id"
                        class="chat-item"
                        :class="{ active: selectedChat?.id === chat.id }"
                        @click="selectChat(chat)"
                    >
                        <div class="chat-name">
                            <p>Чат #{{ chat.id }}</p>
                            <p>{{ chat.ClientFirstName }}</p>
                        </div>
                    </div>
                </div>
                <div v-else class="no-chats">
                    <p>Нет доступных чатов</p>
                </div>
            </template>
        </div>
        <div class="chat-main">
            <div class="chat-header">
                <h3>Рабочая группа</h3>
                <div class="chat-status">3 участника</div>
            </div>

            <div v-if="messages && messages.length" class="messages-container">
                <div
                    v-for="message in messages"
                    :key="message.id"
                    class="message"
                    :class="{
            'sent': (Auth === 'client' && message.user_type === 'client') ||
                   (Auth === 'master' && message.user_type === 'master'),
            'received': (Auth === 'client' && message.user_type === 'master') ||
                       (Auth === 'master' && message.user_type === 'client')
        }"
                >
                    <div class="message-sender">
                        {{
                            (Auth === 'client' && message.user_type === 'client') ||
                            (Auth === 'master' && message.user_type === 'master')
                                ? 'Вы'
                                : Auth === 'client'
                                    ? selectedChat.MasterFirstName
                                    : selectedChat.ClientFirstName
                        }}
                    </div>
                    <div class="message-text">{{ message.message }}</div>
                    <div class="message-time">{{ formatDate(message.created_at) }}</div>
                </div>
            </div>
            <div v-else-if="selectedChat" class="no-messages">
                Нет сообщений в этом чате
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
        Auth: {
            type: String,
            default: ''
        },

        Client_id: {
            type: Number,
            required: false
        },
        Master_id: {
            type: Number,
            required: false
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
                user_type: this.Auth,
                chat_id: null
            },
            selectedChat: null,
            messages: null, // Изначально null для отличия от пустого массива
            isLoading: false,
            // formChat:{
            //     Client_id: this.Client_id,
            //     master_id: 52,
            //     chat_id: 2
            // },
        };
    },

    created() {
        window.Echo.channel('store_message')
            .listen('.store_message', response => {
                console.log('WebSocket message received:', response);

                // Если сообщение относится к текущему чату, добавляем его
                if (this.selectedChat && response.message.chat_id === this.selectedChat.id) {
                    if (!this.messages) this.messages = [];
                    this.messages.push(response.message);
                }
            });
    },

    methods: {
        async sendMessage() {
            if (!this.form.message.trim()) return;

            const data = {
                message: this.form.message,
                chat_id: this.form.chat_id,
                user_type: this.Auth,
            };

            // Добавляем ID в зависимости от роли
            if (this.Auth === 'master') {
                data.master_id = this.Master_id;
                data.client_id = this.selectedChat.client_id;
            } else {
                data.master_id = this.form.master_id;
                data.client_id = this.Client_id;
            }

            try {
                const response = await axios.post('/MainClient/chat/send', data);
                this.$emit('message-sent', response.data);
                this.form.message = '';
            } catch (error) {
                console.error('Ошибка отправки:', error);
                alert('Ошибка отправки: ' + (error.response?.data?.message || error.message));
            }
        },

        // this.selectedChat = chat;
        // this.form.chat_id = chat.id;
        // this.form.master_id = chat.master_id;
        async selectChat(chat) {
            this.selectedChat = chat;
            this.form.chat_id = chat.id;
            this.form.master_id = chat.master_id;

            if (this.Auth === 'master') {
                this.form.master_id = this.Master_id; // ID текущего мастера
            } else {
                this.form.master_id = chat.master_id;
            }

            try {
                const params = {
                    chat_id: chat.id,
                };

                // Добавляем параметры в зависимости от роли
                if (this.Auth === 'master') {
                    params.master_id = this.Master_id;
                    params.client_id = chat.client_id; // Предполагаем, что chat содержит client_id
                } else {
                    params.master_id = chat.master_id;
                    params.client_id = this.Client_id;
                }

                const response = await axios.get('/MainClient/chat/messages', { params });

                this.messages = response.data.messages.map(msg => ({
                    ...msg,
                    master_name: response.data.master_name
                }));

            } catch (error) {
                console.error('Ошибка:', error);
                alert('Ошибка загрузки сообщений: ' + (error.response?.data?.message || error.message));
            }
        },
        formatDate(dateString) {
            return new Date(dateString).toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false // 24-часовой формат (для 12-часового укажите true)
            });
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
