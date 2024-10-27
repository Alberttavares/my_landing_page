import { redirect } from 'next/navigation'

import axios from 'axios'

const BaseApi = axios.create({
	// eslint-disable-next-line no-undef
	baseURL: `${process.env.REACT_APP_API_URL}/api`
})

BaseApi.interceptors.response.use(
	(response) => {
		return response
	},
	(error) => {
		const { response } = error
		if (response.status === 500) {
			redirect('/500-erro')
		}
	}
)

export default BaseApi
