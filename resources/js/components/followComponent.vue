<template>
    <span class="float-right">
      <button v-if="!followed" type="button" class="btn-sm shadow-none border border-primary p-2" @click="follow(user)"><i class="mr-1 fas fa-user-plus"></i>フォロー</button>
      <button  v-else type="button" class="btn-sm shadow-none border border-primary p-2 bg-primary text-white" @click="unfollow(user)"><i class="mr-1 fas fa-user-check"></i>フォロー中</button>
    </span>
</template>

<script>
    export default {
        props:['user', 'defaultFollowed', 'defaultCount'],
        data() {
          return{
              followed: false,
              followCount: 0,
          };
        },
        created() {
          this.followed = this.defaultFollowed
          this.followCount = this.defaultCount
        },

        methods: {
          follow(user) {
            let url = `/users/${user}/follow`

            axios.post(url)
            .then(response => {
                this.followed = true;
                this.followCount = response.data.followCount;
            })
            .catch(error => {
              alert(error)
            });
          },
          unfollow(user) {
            let url = `/users/${user}/unfollow`

            axios.post(url)
            .then(response => {
                this.followed = false;
                this.followCount = response.data.followCount;
            })
            .catch(error => {
              alert(error)
            });
          }
        }
    }
</script>