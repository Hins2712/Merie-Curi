    <?php
        header("Content-type: text/css; charset: UTF-8");
    ?>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; color: #333; }
        section { padding: 20px; display: none; }
        section.active { display: block; }
        #ticker { background-color: #333; color: white; padding: 10px; text-align: center; position: fixed; bottom: 0; width: 100%; overflow: hidden; white-space: nowrap; }
        #ticker span { display: inline-block; animation: ticker 20s linear infinite; }

        @keyframes ticker { 0% { transform: translateX(100%); } 100% { transform: translateX(-100%); } }
        .gallery img { width: 200px; height: auto; margin: 10px; }
        .timeline { position: relative; max-width: 1200px; margin: 0 auto; }
        .timeline::after { content: ''; position: absolute; width: 6px; background-color: #007bff; top: 0; bottom: 0; left: 50%; margin-left: -3px; }
        .container { padding: 10px 40px; position: relative; background-color: inherit; width: 50%; }
        .left { left: 0; }
        .right { left: 50%; }
        .container::after { content: ''; position: absolute; width: 25px; height: 25px; right: -17px; background-color: white; border: 4px solid #007bff; top: 15px; border-radius: 50%; z-index: 1; }
        .right::after { left: -16px; }
        .content { padding: 20px 30px; background-color: white; position: relative; border-radius: 6px; }

        @media screen and (max-width: 600px) { 
        .timeline::after { left: 31px; } 
        .container { width: 100%; padding-left: 70px; padding-right: 25px; } 
        .container::after { left: 18px; } 
        .right { left: 0%; } }
    
        body {
        padding: 0;
        margin: 0;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }

    /* Header styles */
    header {      
        background-color: #66CDAA;
        margin-bottom: 50px;
        width: auto;
        height: auto;
    }

    /* Header container 1 */
    header .header-container1 {
        display: flex;
        align-items: center;
        width: 100%;
        height: auto;
    }
    .logo-header a {
        margin-left: 20%;
    }
    .logo-header a, .logo-header a img {
        width: 54%;
    }
    .header-container1 ul {
        display: flex;
        list-style-type: none;
        width: 100%;
        height: auto;
        margin-right: 0%;
        margin-left: 5%;
        justify-content: space-between;
        align-items: center;
    }
    .header-container1 ul li {
        margin: 0;
    }
    #search-header {
        list-style: none;
        width: 40%;
        margin: 0px 0px 0px 0px;
    }
    .search-container {
        position: relative;
        display: flex;

        width: 60%;
    }
    .search {
        padding-left: 2.5rem;
        height: 38px;
        border: 1px solid #ced4da;
        border-radius: 4px 0 0 4px;
        width: 100%;
        font-size: 16px;
    }
    .search-button {
        background-color: #28a745;
        color: white;
        border: none;
        height: 38px;
        padding: 0 10px;
        border-radius: 0 4px 4px 0;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .search-button:hover {
        background-color: #218838;
    }
    .bi-search {
        position: absolute;
        top: 50%;
        left: 10px;
        transform: translateY(-50%);
        color: black;
        pointer-events: none;
    }
    .bi-cart3 {
        font-size: 1.5rem;
        font-weight: bold;
        filter: brightness(0.7);
    }
    header .header-container1 ul li img {
        display: block;
        max-height: 100px;
        width: auto;
        margin: 0 5px 0 20px;
        padding: 0;
    }
    .header-container1 li a {
        text-decoration: none;
        color: rgb(22, 52, 32);
    }
    .header-container1 li a:hover {
        text-decoration: underline;
    }

    /* Header container 2 */
    header .header-container2 {
        display: flex;
        align-items: center;
        width: 100%;
        padding: 10px 0;
    }
    .header-container2 ul {
        display: flex;
        list-style-type: none;
        margin: 0px;
        padding: 0px;
        width: 100%;
        justify-content: center;
        align-items: center;
    }
    .header-container2 ul li {
        cursor: default;
        position: relative;
        font-size: 16px;
        color: rgb(22, 52, 32);
        font-size: 19px;
        margin: 3.5px;
        padding: 15px 15px;
        border-radius: 5%;
    }
    .header-container2 ul li:hover {
        background-color: rgb(66, 128, 107);
        color: rgb(9, 26, 34);
        font-weight: bold;
    }
    .header-container2 ul a {
        text-decoration: none;
        color: rgb(22, 52, 32);
    }
    .header-container2 .brand .submenu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #66CDAA;
        list-style: none;
        padding: 0;
        margin: 0;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        width: 200px;
        z-index: 1000;
        cursor: pointer;
    }
    .header-container2 .brand .submenu li {
        font-size: 15px;
    }
    .header-container2 .brand .submenu ul li:hover {
        background-color: rgb(66, 128, 107);
        color: rgb(9, 26, 34);
        font-weight: bold;
    }
    .header-container2 .brand:hover .submenu {
        display: block;
    }
    .header-container2 .brand li {
        padding: 10px 15px;
        color: rgb(22, 52, 32);
        font-size: 14px;
    }

    /* Footer styles */
    footer {      
        background-color: #66CDAA;
        height: 300px;
        margin-top: 30px;
    }
    footer .footer-container1 {
        display: flex;
        align-items: center;
        width: 100%;
        padding: 10px 20px;
    }
    .footer-container1 div {
        justify-content: space-between;
        align-items: center;
    }
    .footer-container1 ul {
        list-style-type: none;
    }

    /* Index style */
    .container-index {
        margin: 0 8%;
    }
    .hot {
        height: 500px;
    }
    .hot h1 {
        margin-bottom: 40px;
        text-align: center;
    }
    .hot .hot-images-wrapper {
        display: flex;
        justify-content: center;
        height: auto;
    }
    .hot .hot-images-wrapper a {
        margin: 0 10px;
    }
    .hot .hot-images-wrapper img {
        border-radius: 25px;
        min-height: 50px;
        max-height: 720px;
        width: 100%;
        object-fit: scale-down;
        object-position: center;
    }

    </style>