<script>
    var ids = 51;
</script>
<div id="supportchat-app">
    <chat-log v-bind:messages="messages"></chat-log>
    <chat-composer v-on:sendmessage="addMessage" username="hardcoded"></chat-composer>
</div>

