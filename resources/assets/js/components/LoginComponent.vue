<template>
  <form class="ui form" method="POST" v-bind:action="urlLogin">
    <!-- Ne touchez pas à cette input, elle est utilisée par Laravel -->
    <input type="hidden" name="_token" v-bind:value="csrf">
    <div class="field">
        <label>Email</label>
        <input id="email" type="email" name="email" v-model="oldEmail" required autofocus>
    </div>
    <div class="field">
        <label>Mot de passe</label>
        <input id="password" type="password" name="password" required>
    </div>
    <button type="submit" class="ui button" title="Connexion">
        Connexion
    </button>

    <a class="btn btn-link" v-bind:href="passwordRequest" title="Mot de passe oublié">
        Mot de passe oublié ?
    </a>
  </form>

</template>

<script>
    export default {
        props: ['csrf', 'urlLogin', 'passwordRequest'],
        data () {
            return {
                oldEmail: ''
            }
        }
    }
</script>
