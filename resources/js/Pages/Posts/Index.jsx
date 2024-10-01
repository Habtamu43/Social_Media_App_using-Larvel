import React from 'react';
import { Link } from '@inertiajs/react';

const Index = ({ posts }) => {
    return (
        <div style={{ padding: '20px', maxWidth: '800px', margin: '0 auto' }}>
            <h1 style={{ textAlign: 'center', fontSize: '32px', marginBottom: '20px' }}>Posts</h1>
            
            {/* Button to create a new post */}
            <div style={{ marginBottom: '30px', textAlign: 'center' }}>
                <Link href="/posts/create" style={{ 
                    display: 'inline-block', 
                    padding: '10px 20px', 
                    backgroundColor: '#4CAF50', 
                    color: 'white', 
                    textDecoration: 'none', 
                    borderRadius: '5px' 
                }}>
                    Create New Post
                </Link>
            </div>

            {/* Post List */}
            {posts.length ? (
                posts.map(post => (
                    <div key={post.id} style={{ 
                        border: '1px solid #ddd', 
                        borderRadius: '8px', 
                        padding: '15px', 
                        marginBottom: '20px', 
                        boxShadow: '0px 4px 8px rgba(0, 0, 0, 0.1)' 
                    }}>
                        <h2 style={{ fontSize: '24px', marginBottom: '10px' }}>{post.title}</h2>
                        <p style={{ fontSize: '16px', color: '#555' }}>{post.content}</p>

                        {/* Action Buttons */}
                        <div style={{ marginTop: '15px' }}>
                            <Link href={`/posts/${post.id}`} style={{ 
                                marginRight: '10px', 
                                textDecoration: 'none', 
                                color: '#2196F3' 
                            }}>
                                View Post
                            </Link>
                            <Link href={`/posts/${post.id}/edit`} style={{ 
                                textDecoration: 'none', 
                                color: '#FFC107' 
                            }}>
                                Edit
                            </Link>
                        </div>
                    </div>
                ))
            ) : (
                <p style={{ textAlign: 'center', color: '#888' }}>No posts available.</p>
            )}
        </div>
    );
};

export default Index;

