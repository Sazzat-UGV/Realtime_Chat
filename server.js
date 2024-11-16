import express from "express";
import { createServer } from "http";
import { Server } from "socket.io";
import axios from "axios";

const app = express();
const server = createServer(app);
const API_BASE_URL = "http://127.0.0.1:8000";

const io = new Server(server, {
    cors: {
        origin: "*",
    },
});

let connectedUsers = [];

app.get("/", (req, res) => {
    res.send("");
});

// Socket.io connection event
io.on("connection", (socket) => {
    console.log("New User Connected: ", socket.id);

    socket.on("user_connected", async (userId) => {
        console.log(`User ID: ${userId}, Socket ID: ${socket.id}`);

        try {
            // Save the connected user to the database
            // const response = await axios.post(`${API_BASE_URL}/connected-users`, {
            //     user_id: userId,
            //     socket_id: socket.id,
            // });

            // Add the user to the connectedUsers list
            connectedUsers = connectedUsers.filter(
                (user) => user.userId !== userId
            ); // Remove previous connection if exists
            connectedUsers.push({ userId, socketId: socket.id });

            // Emit the updated user list to all clients
            io.emit("update users", connectedUsers);

            console.log("User saved to the database:", response.data);
        } catch (error) {
            console.error("Error saving user:", error);
        }
        console.log("user: ", connectedUsers);
    });

    // Listen for disconnect event
    socket.on("disconnect", () => {
        console.log("User Disconnected: ", socket.id);
    });
});

// Run the server
server.listen(3000, "127.0.0.1", () => {
    console.log("Server running at http://127.0.0.1:3000");
});
