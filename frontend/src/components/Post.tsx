/* eslint-disable @next/next/no-img-element */
import BaseApi from "@/services/Api";
import { PostType } from "@/types";

export default async function Post() {
    
        const response = await BaseApi.get<PostType[]>('/posts'); 
        const posts: PostType[] = response.data; 
        return (
            <div>
                {posts.map((post: PostType) => (
                    <div key={post.id} style={{ margin: "20px 0" }}>
                        <img
                            src={post.image}
                            alt={post.title}
                            style={{ width: "100%", maxWidth: "640px" }}
                        />
                        <h2>{post.title}</h2>
                        <p>{post.description}</p>
                    </div>
                ))}
            </div>
        );
   
}
