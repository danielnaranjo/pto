<template>
    <div>
    <div class="">
            <div class="" id="accordion">
                {{ group.name }}
                <div class="btn-group pull-right">
                    <a type="button" class="btn btn-default btn-xs"  :href="'#collapseOne-' + group.id">
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </a>
                </div>
            </div>
            <div class="" :id="'collapseOne-' + group.id">
                <div class="chat-panel">
                    <ul class="chat">
                        <li v-for="conversation in conversations">
                        <!-- <span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                        </span> -->
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">{{ conversation.user.name }}</strong>
                                </div>
                                <p>
                                    {{ conversation.message }}
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." v-model="message" @keyup.enter="store()" autofocus />
                        <span class="input-group-btn">
                            <button class="btn btn-warning btn-sm" id="btn-chat" @click.prevent="store()">
                                Send</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['group'],

        data() {
            return {
                conversations: [],
                message: '',
                group_id: this.group.id
            }
        },

        mounted() {
            this.listenForNewMessage();
        },

        methods: {
            store() {
                console.log('store', this);
                axios.post('/conversations', { message: this.message, group_id: this.group.id })
                .then((response) => {
                    console.log('store', response);
                    this.message = '';
                    this.conversations.push(response.data);
                });
            },

            listenForNewMessage() {
                Echo.private('groups.' + this.group.id)
                    .listen('NewMessage', (e) => {
                        console.log('listenForNewMessage', e);
                        this.conversations.push(e);
                    });
            }
        }
    }
</script>
