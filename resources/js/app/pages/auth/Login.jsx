import axios from "axios";
import React, { useState } from "react";
import ReactDOM from "react-dom";
import Button from "../../components/Button/Button";
import IconSocialMedia from "../../components/Icon-social-media/IconSocialMedia";
import Input from "../../components/InputField/Input";
import MessageError from "../../components/Message/MessageError";

function Login(props) {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [remember, setRemember] = useState("");
    const [error, setError] = useState("");
    const [message, setMessage] = useState("");
    const [loading, setLoading] = useState(false);

    const request = {
        email,
        password,
        remember
    };

    const login = async (e) => {
        e.preventDefault();
        console.log(request);
        setError("");
        
        try {
            setMessage("");
            let response = await axios.post(props.endpoint, request);
            
            if (!response.data.error) {
                const user = response.data.user;
                localStorage.setItem('user',JSON.stringify(user));
                setLoading(true);
                setTimeout(() => {
                    return (document.location.href = "/home");
                }, 3000);
            } else {
                setLoading(true);
                
                setTimeout(() => {
                    setLoading(false);
                    setMessage(response.data);
                    setPassword("");
                    setRemember("");
                }, 3000);
            }
        } catch (e) {
            setError(e.response.data.errors);
        }
    };

    return (
        <div className="bg-blue-600">
            <div className="flex items-center justify-center min-h-screen font-sans antialiased tracking-tighter">
                <div className="w-full sm:w-1/3 ">
                    <div className="py-4 overflow-hidden text-blue-600 bg-white border border-gray-200 shadow-md rounded-xl">             
                        <MessageError error={message.error} />
                        <form onSubmit={login} method="POST">
                            <Input
                                name="email"
                                title="Email"
                                type="text"
                                error={error.email}
                                value={email}
                                onChange={(e) => setEmail(e.target.value)}
                            />
                            <div className="flex flex-col py-3 px-14">
                                <label
                                    htmlFor="password"
                                    className="mb-3 text-sm"
                                >
                                    Password
                                </label>
                                <input
                                    type="password"
                                    className="w-full px-4 py-2 text-gray-600 duration-100 border border-blue-400 rounded-full tansition focus:ring focus:ring-blue-200 outline-blue-400 hover:ring hover:ring-blue-300"
                                    name="password"
                                    id="password"
                                    value={password}
                                    onChange={(e) =>
                                        setPassword(e.target.value)
                                    }
                                />
                                {error.password ? (
                                    <div className="mt-3 text-xs text-red-600">
                                        {error.password[0]}
                                    </div>
                                ) : (
                                    ""
                                )}
                               
                            </div>
                            <div className="flex flex-row justify-between py-3 px-14">
                                <div className="flex items-center">
                                    <input className="mr-2 border-gray-400 rounded-full accent-blue-600"  onClick={() =>
                                        setRemember('on')}  type="checkbox" name="remember" id="remember"  value={remember} />
                                    <label htmlFor="remember" className="text-xs text-gray-500 font-sm">Remeber me</label>
                                </div>
                            <div className="flex justify-end mt-2 text-xs text-gray-500 font-sm">
                                    <a
                                        href="/forgot"
                                        className="transition duration-100 hover:underline hover:text-blue-600"
                                    >
                                        Lupa password ?
                                    </a>
                                </div>
                            </div>
                            <Button
                                type="submit"
                                title="Sign In"
                                loading={loading}
                            />
                        </form>

                        <div className="flex flex-col items-center justify-center text-sm ">
                            <p>Silahkan registrasi akun dibawah ini</p>
                            <div className="flex flex-row items-start justify-center my-3 space-x-2">
                                {/* Pemanggilan components secara dinamis */}
                                <IconSocialMedia
                                    href="auth/facebook"
                                    icon="fab fa-facebook-f"
                                    className="bg-blue-600 focus:ring-blue-300 hover:text-blue-600 hover:ring-blue-300"
                                />
                                <IconSocialMedia
                                    href="auth/google"
                                    icon="fab fa-google"
                                    className="bg-red-600 focus:ring-red-300 hover:text-red-600 hover:ring-red-300"
                                />
                            </div>
                            <p className="font-sans text-gray-500 uppercase">
                                atau
                            </p>
                            <a
                                href="/register"
                                className="mt-3 text-gray-500 transition duration-100 hover:text-blue-600 font-md"
                            >
                                Buat akun
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Login;

if (document.getElementById("login")) {
    var item = document.getElementById("login");
    ReactDOM.render(<Login endpoint={item.getAttribute("endpoint")} />, item);
}
