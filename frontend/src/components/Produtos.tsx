/* eslint-disable @next/next/no-img-element */
import BaseApi from "@/services/Api";
import { ProductType } from "@/types";

interface ProdutosProps{
    id: string
}

export default async function Post({ id }: ProdutosProps) {
    
        const response = await BaseApi.get<ProductType>(`/products/${id}`); 
        const products: ProductType = response.data; 
        console.log(products)
        return (
            <div>
                    <div style={{ margin: "20px 0" }}>
                        <img
                            src={products.image}
                            alt={products.name}
                            style={{ width: "100%", maxWidth: "640px" }}
                        />
                        <h2>{products.name}</h2>
                        <h2>{products.price}</h2>

                        <p>{products.description}</p>
                    </div>
            </div>
        );
   
}
