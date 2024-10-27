type PostType = {
	id: string
	title: string
	description: string
	image: string
}

type ProductType = {
	id: string
	name: string
	description: string
    price: number
	image: string
}

export type { ProductType, PostType }
