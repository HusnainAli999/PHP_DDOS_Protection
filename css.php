<style>
    .alert_h1 {
        background: black;
        color: white;
        padding: 20px;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        border-radius: 4px;
        cursor: pointer;
        z-index: 9999;
    }

    .index_h2 {
       background: white;
       color: black;
       box-shadow: 10px 10px 30px gray;
       padding: 20px;  
       margin-bottom: 20px;
    }

    #comment_form {
        width: 500px;
        background: white;
        box-shadow: 10px 10px 30px gray;
        min-height: 150px;
        height: auto;
        position: relative;
        left: 50%;
        transform: translateX(-50%);
        padding: 20px;
    }

    #comment_form label {
        display: inline-block;
        padding: 10px 10px 10px 0px;
        font-size: 20px;
    }

    #comment_form textarea {
        width: 200px;
        padding: 10px;
    }

    #comment_form input {
        background: darkgreen;
        color: white;
        padding: 10px;
        width: 150px;
        border: none;
        outline: none;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 10px;
    }

    #comment_form input:hover {
       background: green;
       transform: scale(1.1);
    }

    .comment_inner_handler_div {
        background: darkred;
        color: white;
        padding: 20px;
        margin-top: 20px;
        border-top: 10px solid white;
    }

    .comment_inner_handler_div .commenter_name {
        font-weight: bold;
        padding-bottom: 10px;
    }
</style>