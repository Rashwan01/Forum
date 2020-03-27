<template>
	<v-container>
		<v-row>
			<v-col cols="6" class="mx-auto mb-10">
				<form>
					<v-text-field
					v-model="form.title"
					label="title"
					required
					></v-text-field>
					<vue-simplemde v-model="form.body" ref="markdownEditor" />
					<v-btn color="primary" class="mr-4" @click="update">update question</v-btn>

				</form>
			</v-col>
		</v-row>
	</v-container>
</template>
<script>
export default{
	props:['data'],
	data(){
		return{
			form:{
				title:this.data.title,
				body:this.data.body,
				category_id:this.data.category_id


			},
			errors:{

			}
		}
	},
	created(){

	},
	methods:{
		update(){
			axios.put(`/api/question/${this.$route.params.slug}`,this.form)
			.then(res=>{

				EventBus.$emit("cancel");

			})
			.catch(error=>console.log(error));
		}
	}

}
</script>
<style>

</style>
