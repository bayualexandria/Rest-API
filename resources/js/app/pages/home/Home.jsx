import React from "react";
import ReactDOM from "react-dom";
import App from "../../layouts/App";

export default function Home(props) {
    return (
        <App >
            <div className="w-full md:w-2/3">
                <header className="py-4 space-y-8 text-white md:py-16 sm:py-8">
                    <h1 className="text-lg font-bold md:text-3xl">
                        Web Programming and Web Design
                    </h1>
                    <p className="text-xs font-normal text-justify md:text-sm">
                        Lorem, ipsum dolor sit amet consectetur adipisicing
                        elit. Repellendus nihil, voluptas vitae maxime
                        blanditiis vero voluptatem accusamus quidem pariatur
                        veniam tempora impedit dolorum! Voluptas mollitia optio
                        consequuntur. Corrupti, iste obcaecati?
                    </p>
                    <button className="md:py-2.5 border shadow-sm md:px-4 bg-white text-black rounded-xl hover:bg-gray-200 transition duration-200 focus:ring focus:ring-gray-600 text-sm px-2 py-1 md:text-md">
                        Lihat selebihnya ...
                    </button>
                </header>
            </div>
        </App>
    );
}

if (document.getElementById("home")) {
    var item = document.getElementById("home");
    ReactDOM.render(
        <Home
            endpoint={item.getAttribute("endpoint")}
        />,
        item
    );
}
