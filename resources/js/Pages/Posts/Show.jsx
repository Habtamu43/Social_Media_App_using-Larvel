import React, { useState } from 'react';

const PostShow = ({ post, comments }) => {
    const [commentContent, setCommentContent] = useState('');

    const handleCommentSubmit = (e) => {
        e.preventDefault();
        fetch(`/posts/${post.id}/comments`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ content: commentContent }),
        }).then(response => {
            if (response.ok) {
                setCommentContent('');
                window.location.reload();
            }
        });
    };

    return (
        <div>
            <h1>{post.title}</h1>
            <p>{post.content}</p>
            <h2>Comments:</h2>
            <ul>
                {comments.map(comment => (
                    <li key={comment.id}>{comment.content}</li>
                ))}
            </ul>
            <form onSubmit={handleCommentSubmit}>
                <textarea
                    value={commentContent}
                    onChange={(e) => setCommentContent(e.target.value)}
                    required
                />
                <button type="submit">Add Comment</button>
            </form>
        </div>
    );
};

export default PostShow;
