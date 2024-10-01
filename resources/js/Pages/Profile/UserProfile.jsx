import React from 'react';

const UserProfile = ({ user, followers, posts }) => {
    return (
        <div>
            <h1>{user.name}'s Profile</h1>
            <h2>Followers: {followers.length}</h2>
            <h3>Posts:</h3>
            <ul>
                {posts.map(post => (
                    <li key={post.id}>{post.title}</li>
                ))}
            </ul>
            {/* Follow/Unfollow button (conditional rendering based on follow status) */}
            <button onClick={() => handleFollow(user.id)}>
                {user.isFollowed ? 'Unfollow' : 'Follow'}
            </button>
        </div>
    );
};

const handleFollow = (userId) => {
    // Implement follow/unfollow logic
    const url = user.isFollowed ? `/users/${userId}/unfollow` : `/users/${userId}/follow`;
    fetch(url, {
        method: user.isFollowed ? 'DELETE' : 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    }).then(response => {
        if (response.ok) {
            // Update the state or refresh the page
            window.location.reload();
        }
    });
};

export default UserProfile;

