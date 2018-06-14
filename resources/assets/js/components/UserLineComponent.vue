<template>
  <tr v-bind:class="{ positive: updated }">
      <td v-if="updated == true"><i class="icon checkmark"></i></td>
      <td v-else>{{ userData.id }}</td>
      <td v-if="icon=='save'" class="bg-whitesmoke" v-bind:class="inputNameValid" style="width: 300px;">
          <div  class="ui transparent labeled left icon fluid input focus">
              <i class="edit icon"></i>
              <input type="text" v-model="updateName">
          </div>
      </td>
      <td v-else style="width: 300px;">
          {{ userData.name }}
      </td>
      <td v-if="icon=='save'" class="bg-whitesmoke" v-bind:class="inputEmailValid" style="width: 300px;">
          <div  class="ui transparent labeled left icon fluid input focus">
              <i class="edit icon"></i>
              <input type="email" v-model="updateEmail">
          </div>
      </td>
      <td v-else style="width: 300px;">
          {{ userData.email }}
      </td>
      <td><time v-bind:datetime="userData.created_at">{{ userData.created_at }}</time></td>
      <td><time v-bind:datetime="userData.updated_at">{{ userData.updated_at }}</time></td>
      <td><i v-on:click="editUser" v-bind:title="icon + ' ' + titleIcon" class="material-icons">{{ icon }}</i>
          <i v-if="icon=='save'" v-on:click="clearUser" class="material-icons" title="cancel">clear</i>
          <i v-else v-bind:style="{ visibility: isNotVisible }" class="material-icons " title="cancel">clear</i></td>
  </tr>
</template>

<script>
let emailRE = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/

  module.exports = {
    props: {
        userData: Object,
    },
    data: function () {
        return {
            icon: 'edit',
            message: ' user',
            isNotVisible: 'hidden',
            updateName: '',
            updateEmail: '',
            inputNameValid: 'ok',
            inputEmailValid: 'ok',
            updated: false,
        }
    },
    computed: {
        validation: function () {
            return {
                name: !!this.updateName.trim(),
                email: emailRE.test(this.updateEmail)
            }
        },
        isValid: function () {
            const validation = this.validation;
            return Object.keys(validation).every(function (key) {
                return validation[key]
            })
        },
        titleIcon: function () {
          if (this.icon == 'edit') {
            return this.userData.name;
          } else {
            return this.updateName;
          }
        }
    },
    methods: {
        editUser: function () {
            this.updated = false;
            // console.log(this.userData);
            // console.log(this.isValid);
            if (this.icon === 'edit') {
                this.icon = 'save';
                this.updateName = this.userData.name;
                this.updateEmail = this.userData.email;
            } else {
              this.updated = false;
                if (this.updateName === this.userData.name && this.updateEmail === this.userData.email) {
                    this.icon = 'edit';
                    this.inputNameValid = 'ok';
                    this.inputEmailValid = 'ok';
                    this.updated = false;
                } else {
                    if (this.isValid) {
                        this.userData.name = this.updateName;
                        this.userData.email = this.updateEmail;
                        const updatedDate = new Date();
                        const jsonDate = updatedDate.toJSON();
                        const fullDate = jsonDate.split('T');
                        this.userData.updated_at = fullDate[0] + ' ' + updatedDate.toLocaleTimeString('fr-FR');
                        console.log(this.userData);
                        this.icon = 'edit';
                        this.inputNameValid = 'ok';
                        this.inputEmailValid = 'ok';
                        this.updated = true;
                        this.updateUser();
                        setTimeout(this.updatedOk, 3000);
                    } else {
                        (this.validation.name ? this.inputNameValid = 'ok' : this.inputNameValid = 'error');
                        (this.validation.email ? this.inputEmailValid = 'ok' : this.inputEmailValid = 'error');
                    }
                }
            }
        },
        updatedOk: function () {
          console.log("coucou");
          return this.updated = false;
        },
        updateUser: function () {
          axios.put('/api/userscollectionupdate/' + this.userData.id,  {
                      name: this.userData.name,
                      email: this.userData.email,
                      updated_at: this.userData.updated_at
                      }
                    )
                    .then(function (response) {
                      console.log(response);
                    })
                    .catch(function (error) {
                      console.log(error);
                    });
        },
        clearUser: function () {
            this.icon = 'edit';
            this.updated = false;
            this.inputNameValid = 'ok';
            this.inputEmailValid = 'ok';
        }

    }
  }
</script>
