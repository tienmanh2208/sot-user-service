db.createUser(
    {
        user: "app",
        pwd: "secret",
        roles: [
            {
                role: "readWrite",
                db: "app"
            }
        ]
    }
);
