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
        try {
            // Add the user to the connectedUsers list
            connectedUsers = connectedUsers.filter(
                (user) => user.userId !== userId
            );
            connectedUsers.push({ userId, socketId: socket.id });

            // Emit the updated user list to all clients
            io.emit("active_user", connectedUsers);
        } catch (error) {
            console.error("Error saving user:", error);
        }
        console.log("connectedUsers: ", connectedUsers);
    });

    socket.on("message", (data) => {
        const { receiverId, message, senderId } = data;
        const receiverSocketId = connectedUsers[receiverId];

        if (receiverSocketId) {
            io.to(receiverSocketId).emit("msg", {
                senderId: senderId,
                message: message,
                senderName: "Sender Name", // You can replace this with real user data
                createdAt: new Date().toLocaleTimeString(),
            });
        } else {
            console.log(`User ${receiverId} is not connected`);
        }
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
