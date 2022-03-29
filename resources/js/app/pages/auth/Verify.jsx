import axios from "axios";
import React, { useState } from "react";
import ReactDOM from "react-dom";
import Button from "../../components/Button/Button";
import MessageError from "../../components/Message/MessageError";
import MessageSuccess from "../../components/Message/MessageSuccess";

export default function Verify(props) {
    console.log(props.request);
    const [loading, setLoading] = useState(false);
    const [message, setMessage] = useState("");
    const [error, setError] = useState("");
    const [messageError, setMessageError] = useState("");

    const verify = async (e) => {
        e.preventDefault();

        setLoading(true);
        try {
            let response = await axios.post(props.endpoint);
            console.log(response.data);

            setTimeout(() => {
                setMessage(response.data);
                setLoading(false);
                setTimeout(() => {
                    setMessage("");
                }, 5000);
            }, 3000);
        } catch (e) {
            if (e.response.data) {
                setTimeout(() => {
                    setError(e.response.data);
                    setTimeout(() => {
                        setLoading(false);
                        setError("");
                        setMessageError("Pengiriman gagal...");
                        setTimeout(() => {
                            setMessageError("");
                        }, 5000);
                    }, 5000);
                }, 10000);

                console.log("Connection time out");
            }
        }
    };
    console.log(props.endpoint);
    return (
        <div className="bg-blue-600">
            <div className="flex items-center justify-center min-h-screen antialiased tracking-tighter">
                <div className="mx-3 md:w-1/3 sm:w-full">
                    {error ? (
                        <div className="flex justify-center">
                            <div className="my-5 md:w-36">
                                <div className="flex items-center justify-center px-2 py-1 text-sm font-normal text-white bg-red-400 rounded-full shadow-sm animate-pulse">
                                    Koneksi terputus
                                </div>
                            </div>
                        </div>
                    ) : (
                        ""
                    )}
                    <div className="px-4 py-6 overflow-hidden bg-white border border-gray-200 shadow-md rounded-xl">
                        <div className="flex flex-col items-center justify-center">
                            <i className="mt-2 text-4xl text-green-500 far fa-check-circle animate-bounce"></i>
                            <div className="py-4 space-y-2 font-sans text-sm font-medium text-center text-gray-500">
                                <MessageSuccess success={message.success} />
                                <MessageError error={messageError} />

                                <p c>
                                    Silahkan cek email anda untuk verifikasi
                                    akun?
                                </p>
                                <p>
                                    Jika belum menerima pesan verifikasi
                                    silahkan klik tombol dibawah ini untuk
                                    mengirimkan ulang.
                                </p>
                            </div>

                            <form method="post" onSubmit={verify}>
                                <Button
                                    type="submit"
                                    title="Verifikasi email"
                                    className="bg-green-600 hover:bg-green-500 focus-within:ring-green-400"
                                    loading={loading}
                                />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

if (document.getElementById("verify")) {
    var item = document.getElementById("verify");
    ReactDOM.render(<Verify endpoint={item.getAttribute("endpoint")} />, item);
}
