
<head>
    <style>
        .footer-dm{
            background-color: #292c2f;
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.12);
            box-sizing: border-box;
            width: 100%;
            text-align: left;
            font: normal 16px sans-serif;

            padding: 10px 30px;

            @if (!isset($margin) || $margin==null)
                margin-top: 50px;
            @endif
        }
        .fixed-footer{
            position: fixed;
            bottom: 0;
        }

        .footer-dm .footer-left p{
            color:  #8f9296;
            font-size: 12px;
            margin: 0;
        }

        /* Footer links */

        .footer-dm p.footer-links{
            font-size:15px;
            font-weight: bold;
            color:  #ffffff;
            margin: 0 0 10px;
            padding: 0;
        }

        .footer-dm p.footer-links a{
            display:inline-block;
            line-height: 1.8;
            text-decoration: none;
            color:  inherit;
        }

        .footer-dm .footer-right{
            float: right;
            margin-top: 6px;
            max-width: 300px;
            color: white;
        }

        @media (max-width: 600px) {

            .footer-dm .footer-left,
            .footer-dm .footer-right{
                text-align: center;
            }

            .footer-dm .footer-right{
                float: none;
                margin: 0 auto 20px;
            }

            .footer-dm .footer-left p.footer-links{
                line-height: 1.8;
            }
        }

    </style>
</head>


<footer class="footer footer-dm" id="footer">
    <div class="footer-left">

        <p class="footer-links">Trung tâm máy tính (CCNE) - Trường ĐH Công Nghệ - ĐHQGHN </p>

        <p>Copyright &copy; ccne 2016</p>
    </div>

</footer>

<script type="text/javascript">
    function checkFixedBottomPos(){
        var minDis= 20;
        var cap = $('#footer').css('height');
        cap = parseInt(cap.substring(0, cap.length-2));

        var distanceBottom = $(document).height() - ($(window).scrollTop() + $(window).height());

        var marginBottom;

        if (distanceBottom < cap) {
            marginBottom = (cap - distanceBottom) + minDis;
        }
        else {
            marginBottom=minDis;
        }

        $('.needFixed').css('bottom', marginBottom+"px");
    }

    function checkMinHeight(){
        var div = $('.index').height();
        var win = $(window).height();
        
        if (win >= div){
            $('.beforeFooter').css('min-height', (win - $('#mainNav').height() - $('.footer-dm').height()-21 - 50) + "px");
        }
    }

    $(document).ready(function(){
        checkMinHeight();
        checkFixedBottomPos();
        $(window).on('scroll',function(e)
        {
            checkFixedBottomPos();
            checkMinHeight();
        });
        $(window).on('resize',function(e)
        {
            checkFixedBottomPos();
            checkMinHeight();
        });
    });
</script>