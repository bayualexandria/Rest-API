import axios from "axios";
import React, { useState } from "react";
import ReactDOM from "react-dom";
import Button from "../../components/Button/Button";
import Input from "../../components/InputField/Input";

export default function Register(props) {
    const [name, setName] = useState("");
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [confPassword, setConfPassword] = useState("");
    const [error, setError] = useState("");
    const [loading, setLoading] = useState(false);

    const request = {
        name,
        email,
        password,
        password_confirmation: confPassword,
    };

    const register = async (e) => {
        e.preventDefault();
        setError("");
        try {
            
            let response = await axios.post(props.endpoint, request);

            if (!response.data.error) {
                setLoading(true);
                setTimeout(() => {
                    return document.location.href="/email/verify";
                }, 3000);
                
            }

            console.log(response.data);
        } catch (e) {
            setError(e.response.data.errors);
            setPassword("");
            setConfPassword("");
            console.log(e.response.data.errors);
        }
    };

    return (
        <div className="bg-blue-600">
            <div className="flex items-center justify-center min-h-screen antialiased tracking-tighter">
                <div className="md:w-1/3 sm:w-full">
                    <div className="py-4 overflow-hidden text-blue-600 bg-white border border-gray-200 shadow-md rounded-xl">
                        <form method="post" onSubmit={register}>
                            <Input
                                name="name"
                                title="Nama Lengkap"
                                error={error.name}
                                value={name}
                                onChange={(e) => setName(e.target.value)}
                            />

                            <Input
                                name="email"
                                title="Email"
                                error={error.email}
                                value={email}
                                onChange={(e) => setEmail(e.target.value)}
                            />

                            <Input
                                name="password"
                                title="Password"
                                type="password"
                                error={error.password}
                                value={password}
                                onChange={(e) => setPassword(e.target.value)}
                            />

                            <Input
                                name="password_confirmation"
                                title="Konfirmasi Password"
                                type="password"
                                error={error.password_confirmation}
                                value={confPassword}
                                onChange={(e) =>
                                    setConfPassword(e.target.value)
                                }
                            />

                            <Button type="submit" title="Sign Up" loading={loading} />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    );
}

if (document.getElementById("register")) {
    var item = document.getElementById("register");
    ReactDOM.render(
        <Register endpoint={item.getAttribute("endpoint")} />,
        item
    );
}
