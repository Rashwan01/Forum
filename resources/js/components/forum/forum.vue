<template>
	<v-container fluid>
		<v-row>
			<v-col cols="12">
				<h1 class="grey--text"> Questions</h1>
			</v-col>
			<v-col cols="8">
				<questions v-for="da in data" :key="da.title" :data='da'></questions>
			</v-col>




			<v-col cols="4">
		<sidebar></sidebar>
			</v-col>
		</v-row>
	</v-container>
</template>

<script>
import questions from "./questions"
import sidebar from "./sidebar"
export default{
	data(){
		return {
			data:{}
		}
	},
	created(){
		axios.get("api/question")
		.then(res=>this.data = res.data.data)
		.catch(error=>console.log(error))

	},
	components:{
		questions,sidebar
	}

}
</script>

<style>


</style>
