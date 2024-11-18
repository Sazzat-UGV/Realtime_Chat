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
    console.log("New User Connected:", socket.id);

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
        console.log("Active Users: ", connectedUsers);
    });

    socket.on("private_message", (data) => {
        const { message, receiver_id } = data;
        // Find the receiver's socket ID
        const receiver = connectedUsers.find(
            (user) => user.userId == data?.receiver_id
        );
        if (receiver?.socketId) {
            // Send the message to the receiver
            io.to(receiver.socketId).emit("chat message", {
                senderId: data.sender_id,
                message,
            });
        }
        // Send the message back to the sender's chatbox
        socket.emit("chat message", {
            senderName: "You",
            message,
            createdAt: new Date().toLocaleTimeString(),
        });
    });

    // Listen for disconnect event
    socket.on("disconnect", () => {
        console.log("User Disconnected: ", socket.id);
    });
});

// Run socket server
server.listen(3000, "127.0.0.1", () => {
    console.log("Server running at http://127.0.0.1:3000");
});
