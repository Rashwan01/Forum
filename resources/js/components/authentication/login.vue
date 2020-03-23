<template>
	<v-container class="mt-5">
		<v-form
		ref="form"
		v-model="valid"
		lazy-validation
		>

		<v-text-field
		v-model="email"
		:rules="emailRules"
		label="E-mail"
		required
		></v-text-field>

		<v-text-field
		v-model="password"
		:rules="passwordRules"
		type="password"
		label="password"
		required
		></v-text-field>

		<v-btn
		color="primary"
		class="mr-4"
		@click="login"
		>
		login
	</v-btn>

	<v-btn
	color="success"
	class="mr-4"
	to ="/signup"
	>
	sign Up
</v-btn>
</v-form>
</v-container>
</template>

<script>
export default {
	data: () => ({
		valid: true,
		loading:false,
		password: '',
		passwordRules: [

		v => !!v || 'password is required',
		],
		email: '',
		emailRules: [
		v => !!v || 'E-mail is required',
		v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
		],
	}),
	created(){
		if(User.isLogin()){
			this.$router.push({name:"forum"})
		}
	},
	methods: {

		login () {
			User.login({email:this.email,password:this.password})
	

			
		},

	},
}
</script>

<style>


</style>
