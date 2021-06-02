<style>
    form .row {
      display: block;
      display: flex;
      align-items: flex-start;
      flex-direction: row;
      flex-wrap: wrap;
    }
    form .row .tab {
      width: 100%;
      display: flex;
      align-items: flex-start;
      flex-direction: row;
      flex-wrap: wrap;
      display: none;
    }
    form .row .tab.current {
      display: flex;
      border: 1px solid #cecece;
      background-color: #f9f9f9;
      padding:10px;
      margin-bottom: 10px;
    }
    form .row .tab > label {
      display: block;
      width: 50%;
      padding: 0px 10px 10px;
    }
    form .row .tab > label > label {
      display: block;
    }
    form select {
      width: 100%;
    }
    p.ok, p.error {
      background-color: green;
      padding: 10px;
      color: #fff;
    }
    p.error {
      background-color: red;
    }
    @media (max-width: 600px) {
      form .row .half {
        width: 100%;
      }
    }

    p.minilegal {
      padding: 10px;
      font-size: 12px;
      border: 1px solid #cecece;
      height: 80px;
      overflow-y: scroll;
    }

    form ul.tabs-selector {
      margin: 0px;
      padding: 0px;

    }
    form ul.tabs-selector li {
      display: inline-block;
      padding: 10px;
      font-size: 20px;
      border-top: 1px solid #cecece;
      border-left: 1px solid #cecece;
      border-right: 1px solid #cecece;
      cursor: pointer;
    }
    form ul.tabs-selector li.current {
      background-color: #f9f9f9;
    }

    form input[type=submit]:disabled {
      opacity: 0.5;
    }
  </style>