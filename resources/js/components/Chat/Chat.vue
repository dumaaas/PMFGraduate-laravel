<template>
    <div>
        <div class="showChat" v-show="showChat">
            <p class="activeUsers">Active friends</p>
            <hr>
            <div v-for="user in users" @click="openUser(user)" class="user">
                <ul id="activeUser">
                    <li>
                        <img :src="'/images/users/'+user.avatar" alt="" style="border-radius: 50%" width="50px" height="50px">
                    </li>
                    <li class="user-info">
                        <p>{{user.firstName}} {{user.lastName}}</p>
                    </li>
                    <i class="fa fa-circle circleStyle"></i>
                </ul>
            </div>
        </div>
        <button @click.prevent="openChat()" class="chat">Chat</button>
        <div class="showUser" v-show="showUser">
            <div class="top-part">
                <p id="username"></p>
                <a href="#" class="closeButton" @click="closeUser()">X</a>
            </div>

            <div id="mid-part">
                <div v-for="message in messages">
                    <div class="message" v-if="message.sender_user_id==id">
                        <img :src="'/images/users/'+message.sender_user.avatar" alt="">
                        <p class="receivedMessage">
                            {{message.message}}
                        </p>
                    </div>
                    <div class="message2" v-else>
                        <p class="sendedMessage">{{message.message}}</p>
                    </div>
                </div>
            </div>
            <div class="bottom-part">
                <input type="text" name="message" v-model="message" >
                <i @click.prevent="sendMessage" class="fa fa-paper-plane sendMessage" aria-hidden="true"></i>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            showChat: false,
            users: '',
            showUser: false,
            message: '',
            messages: [],
            id: ''
        }
    },

    created() {
        this.getUsers();
    },

    methods: {
        openChat() {
            this.showChat = !this.showChat;
        },

        getUsers() {
            axios.get('/users')
                .then(response => {
                    this.users = response.data
                })
        },

        openUser(user) {
            const x = document.getElementById("username")
            this.getChat(user.id)
            this.scrollDown()

            this.id = user.id

            x.innerHTML = user.firstName+' '+user.lastName

            this.showUser = true;

        },

        getChat(id) {
            axios.get('/showChat/'+id)
                .then(response => {
                    this.messages = response.data
                    console.log(response.data)
                })
        },

        closeUser() {
            this.showUser = false;
        },

        sendMessage() {
            axios.post('/sendMessage/'+this.id+'/'+this.message)
                .then(response => {
                    console.log(response)
                    this.messages.push(response.data)
                })
            this.scrollDown()
        },

        scrollDown() {
            var chat = this.$el.querySelector("#mid-part")
            chat.scrollTop = chat.scrollHeight
        }
    }
}
</script>

<style scoped>

    .showChat {
        position: fixed;
        right: 0;
        bottom: 3%;
        width: 18%;
        height: 60%;
        background-color: black;
        border: 1px solid #233A50;
    }

    .chat {
        position: fixed;
        right: 0;
        bottom: 0;
        width: 18%;
        height: 3%;
        background-color: #233A50;
        color: white;
        border: 0px;
        border-radius: 3px;
    }

    .activeUsers {
        font-size: 20px;
        font-weight: bold;
        margin-top: 2%;
        margin-left: 2%;
    }

    #activeUser {
        list-style: none;
        font-size: 15px;
        font-weight: bold;
        margin-top: 2%;
        margin-left: 2%;
        position: relative;
    }

    #activeUser > li {
        display: inline-block;
    }

    .user-info {
        margin-left: 2%;
    }

    #activeUser .circleStyle {
        position: absolute;
        top: 77%;
        left: 10%;
        color: green;
    }

    .showUser {
        position: fixed;
        background-color: black;
        border: 1px solid #233A50;
        width: 18%;
        height: 45%;
        bottom: 0;
        left: 63%;
    }

    .user:hover {
        background-color: #233A50;
        padding-top: 2%;
        padding-bottom: 0.1%;
    }

    .top-part {
        position: fixed;
        width: 18%;
        height: 4%;
        background-color: #233A50;
    }

    .closeButton {
        position: absolute;
        top:0;
        right: 1%;
        pointer: cursor;
    }

    #username {
        margin-left: 2%;
        margin-top: 2%;
        font-size: 15px;
        font-weight: bold;
    }

    .bottom-part {
        position: absolute;
        bottom: 0;
    }

    .bottom-part input {
        margin-left: 5%;
        margin-bottom: 3%;
        width: 160%;
        border-radius: 10px;
        background-color: #233A50;
        border: 0px;
        color: white;
    }

    .sendMessage {
        position: fixed;
        bottom: 1.2%;
        right: 20%;
        font-size: 20px;
        color: #233A50;
    }

    #mid-part {
        position: absolute;
        top: 10%;
        bottom: 13%;
        height: 79%;
        width: 100%;
        overflow-y: auto;
        scroll-behavior: smooth;
    }

    .message {
        display: flex;
    }

    .message img {
        display: block;
        margin-left: 2%;
        width: 35px;
        height: 35px;
        border-radius: 50%;
    }


    .receivedMessage {
        margin-left: 4%;
        margin-bottom: 2%;
        margin-right: 50%;
        padding: 1%;
        border-radius: 10px;
        background-color: #233A50;
    }

    .message2 {
        display: flex;
    }

    .sendedMessage {
        float: right;
        margin-left: 50%;
        margin-bottom: 2%;
        margin-right: 2%;
        padding: 1%;
        border-radius: 10px;
        background-color: dodgerblue;
    }

</style>
