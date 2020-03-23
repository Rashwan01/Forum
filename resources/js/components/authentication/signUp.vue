<template>
	<v-container class="mt-5">
		<v-form 

		>
		<v-text-field
		v-model="form.name"
		label="name"
		type="text"
		required
		></v-text-field>
		<span class="red--text" v-if= "errors.name" v-text="errors.name[0]"></span>
		<v-text-field
		v-model="form.email"
		label="E-mail"
		required
		></v-text-field>
		<span class="red--text" v-if= "errors.email" v-text="errors.email[0]"></span>
		<v-text-field
		v-model="form.password"
		type="password"
		label="password"
		required
		></v-text-field>
		<span class="red--text" v-if= "errors.password" v-text="errors.password [0]"></span>
		<v-text-field
		v-model="form.password_confirmation"
		type="password"
		label="password_confirmation"
		required
		></v-text-field>
		<v-btn
		color="primary"
		class="mr-4"
		to ="/login"
		>
		login
	</v-btn>
	<v-btn
	@click.prevent="register"
	color="success"
	class="mr-4"

	>
	signUp
</v-btn>

</v-form>
</v-container>
</template>

<script>
export default {
	data: () => ({
		form:{
			name:null,
			email:null,
			password:null,
			password_confirmation:null,
		},
		errors:{}
	}),

	created(){
		if(User.isLogin()){
			this.$router.push({name:"forum"})
		}
	},
	methods: {

		register () {
			axios.post("/api/auth/signup",this.form)
			.then(res=>{ 
				User.responseAfterLogin(res)
				this.$router.push({name:"forum"})
			})
			.catch(error=>this.errors = error.response.data.errors)

		},

	},

}
</script>

<style>


</style>
