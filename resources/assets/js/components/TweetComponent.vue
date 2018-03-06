<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Tweet Scheduler</div>

                    <div class="panel-body">
                        <div class="form-group">
                            <input maxlength="280" autofocus class="form-control" placeholder="Content" v-model="newTweet.content">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="datetime-local" placeholder="Description" v-model="newTweet.publish_timestamp">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success" v-on:click="addTweet(newTweet)">Add Tweet</button>
                        </div>
                        <ul v-if="ready" class="list-group">
                            <li v-for="post in tweets" class="list-group-item clearfix">
                                {{post.content}}
                                <span class="pull-right button-group">
                         <button class=" btn btn-default" v-on:click="openEditTweet(post)">Edit</button>
                         <button class=" btn btn-danger" v-on:click="deleteTweet(post)">Delete</button>
                       </span>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div id="editModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{selectedTweet.content}}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input class="form-control" placeholder="Content" v-model="selectedTweet.content">
                        </div>
                        <div class="form-group">

                            <input class="form-control" type="datetime-local" placeholder="Publish At" v-model="selectedTweet.publish_timestamp">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-info" v-on:click="editTweet(selectedTweet)">Edit Tweet</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return {
                tweets: {},
                newTweet:{
                    'content': '',
                    'publish_timestamp': ''
                },
                selectedTweet:{
                    'content': '',
                    'publish_timestamp': ''
                },
                ready: false
            }
        },
        created(){
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', function() {
                    navigator.serviceWorker.register('/background.js').then(function(registration) {
                    }, function(err) {
                        // registration failed :(
                        console.log('ServiceWorker registration failed: ', err);
                    });
                });
            }
            axios.get('/api/tweet').then(function(data){
                this.tweets = data.data;
                this.ready = true;
            });
        },
        methods: {
            addTweet: function(tweet){
                axios.post('/api/tweet',tweet).then(function(data){
                    this.tweets.unshift({content:tweet.content,publish_timestamp:tweet.publish_timestamp});
                });
            },
            editTweet: function(tweet){
                axios.put('/api/tweet/'+tweet.id,this.selectedTweet).then(function(data){
                    let index = this.tweets.indexOf(tweet);
                    this.tweets[index] = tweet;
                    alert('Updated!');
                    $("#editModal").modal('hide');
                });
            },
            openEditTweet: function(tweet){
                console.log(tweet);
                this.selectedTweet = tweet;
                $("#editModal").modal({show: true});
            },
            deleteTweet: function(tweet){
                axios.delete('/api/tweet/'+tweet.id).then(function(data){
                    let index = this.tweets.indexOf(tweet)
                    this.tweets.splice(index, 1);
                });
            }
        }
    }
</script>