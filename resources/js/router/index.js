	import Vue from 'vue'
	import VueRouter from 'vue-router'
	import login from '../components/authentication/login'
	import signUp from '../components/authentication/signup'
	import logout from '../components/authentication/logout'
	import forum from '../components/forum/forum'
	import question from '../components/forum/question'
	import askQuestion from '../components/forum/createQuestion'
	Vue.use(VueRouter)

	const routes = [
	{
		path: '/login',
		component:login
	},
	{
		path: '/logout',
		component:logout
	},
	{
		path: '/signup',
		component:signUp
	},
	{
		path: '/forum',
		component:forum,
		name:"forum"
	},
	{
		path: '/question/:slug',
		component:question,
		name:"question"
	},
	{
		path: '/askquestion/',
		component:askQuestion,
		name:"askQuestion"
	},
	]

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
  routes, // short for `routes: routes`,
  mode: 'history',
});

export default router
