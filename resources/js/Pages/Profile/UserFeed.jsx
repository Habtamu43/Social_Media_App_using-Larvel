// resources/js/Pages/UserFeed.jsx

import React from 'react';

const UserFeed = ({ posts }) => {
    return (
        <div>
            <h1>Your Feed</h1>
            {posts.length > 0 ? (
                <ul>
                    {posts.map(post => (
                        <li key={post.id}>
                            <h2>{post.title}</h2>
                            <p>{post.content}</p>
                            {/* Add more post details as needed */}
                        </li>
                    ))}
                </ul>
            ) : (
                <p>No posts to display.</p>
            )}
        </div>
    );
};

export default UserFeed;
