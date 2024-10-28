/* eslint-disable @next/next/no-img-element */
import BaseApi from "@/services/Api";
import { ProductType } from "@/types";

interface ProdutosProps{
    id: string
}

export default async function Post({ id }: ProdutosProps) {
    
        const response = await BaseApi.get<ProductType>(`/products/${id}`); 
        const products: ProductType = response.data; 
        const price_convert = products.price.toString();
        return (
            <div className="bg-stone-950 h-[410px] rounded-md">
                    <div className="w-72 h-72 p-2"> 
                        <img
                            src={products.image}
                            alt={products.name}
                            className="rounded-md"
                        />
                        <div className="flex flex-col gap-2">
                            <h1 className="text-white text-2xl truncate">{products.name}</h1>
                            <h2 className="text-white">
                                {parseFloat(price_convert).toLocaleString('pt-br', {
                                style: 'currency',
                                currency: 'BRL'
                                })}
                            </h2>
                            <p className="text-white">{products.description}</p>
                        </div>
                    </div>
            </div>
        );
   
}
