  import 'package:flutter/material.dart';

import '../constants.dart';

  class BodyAccount extends StatefulWidget {
    const BodyAccount({Key? key}) : super(key: key);

    @override
    State<BodyAccount> createState() => _BodyAccountState();
  }

  class _BodyAccountState extends State<BodyAccount> {
    @override
    Widget build(BuildContext context) {
      return Padding(padding: EdgeInsets.symmetric(vertical: 0,horizontal: 15.0),
        child: Column(
          children: [
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Row(
                  children: [
                    Container(
                      margin: EdgeInsets.only(right: 10.0),
                      child: Image.asset("assets/images/account.png"),
                    ),
                    Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: const [
                        Text("Lê Quốc Dũng",style: TextStyle(color: bLtitleColor,fontSize: 17,fontWeight: FontWeight.w700),),
                        SizedBox(height: 6.0,),
                        Text("Chỉnh sửa",style: TextStyle(color: textgreyColor,fontSize: 13),),
                      ],
                    )
                  ],
                ),
                const Icon(Icons.navigate_next),
              ],
            ),
            Container(
              height: 1,
              margin: EdgeInsets.symmetric(vertical: 20.0),
              color: linegreyColor,
            ),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: const [
                Text("Giỏ hàng",style: TextStyle(color: bLtitleColor,fontSize: 16,fontWeight: FontWeight.w400),),
                Icon(Icons.navigate_next),
              ],
            ),
            Container(
              height: 1,
              margin: EdgeInsets.symmetric(vertical: 20.0),
              color: linegreyColor,
            ),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: const [
                Text("Đơn hàng",style: TextStyle(color: bLtitleColor,fontSize: 16,fontWeight: FontWeight.w400),),
                Icon(Icons.navigate_next),
              ],
            ),
            Container(
              height: 1,
              margin: EdgeInsets.symmetric(vertical: 20.0),
              color: linegreyColor,
            ),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: const [
                Text("Phiếu giảm giá & mã khuyến mãi",style: TextStyle(color: bLtitleColor,fontSize: 16,fontWeight: FontWeight.w400),),
                Icon(Icons.navigate_next),
              ],
            ),
            Container(
              height: 1,
              margin: EdgeInsets.symmetric(vertical: 20.0),
              color: linegreyColor,
            ),

            Row(
              children: [
                Expanded(child: Container(
                  decoration: BoxDecoration(
                    color: bgsale,
                    borderRadius: BorderRadius.circular(10),
                  ),
                  child: Padding(padding:const EdgeInsets.symmetric(vertical: 15,horizontal: 15),
                    child: Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: const [
                        Text("10%",style: TextStyle(fontWeight: FontWeight.w400,fontSize: 16,color: Colors.white),),
                        Text("Khi mua đơn hàng 200k",style: TextStyle(fontSize: 13,color: Colors.white),),
                      ],
                    ),
                  ),
                ),),
                const SizedBox(width: 15,),
                Expanded(child: Container(
                  decoration: BoxDecoration(
                    color: bgsale,
                    borderRadius: BorderRadius.circular(10),
                  ),
                  child: Padding(padding:const EdgeInsets.symmetric(vertical: 15,horizontal: 15),
                    child: Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: const [
                        Text("50%",style: TextStyle(fontWeight: FontWeight.w400,fontSize: 16,color: Colors.white),),
                        Text("Khi mua đơn hàng 2000k",style: TextStyle(fontSize: 13,color: Colors.white),),
                      ],
                    ),
                  ),
                ),),

              ],
            ),
            Container(
              height: 1,
              margin: EdgeInsets.symmetric(vertical: 20.0),
              color: linegreyColor,
            ),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: const [
                Text("Địa chỉ giao hàng",style: TextStyle(color: bLtitleColor,fontSize: 16,fontWeight: FontWeight.w400),),
                Icon(Icons.navigate_next),
              ],
            ),
            Container(
              height: 1,
              margin: EdgeInsets.symmetric(vertical: 20.0),
              color: linegreyColor,
            ),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: const [
                Text("Hỏi đáp",style: TextStyle(color: bLtitleColor,fontSize: 16,fontWeight: FontWeight.w400),),
                Icon(Icons.navigate_next),
              ],
            ),
            Container(
              height: 1,
              margin: EdgeInsets.symmetric(vertical: 20.0),
              color: linegreyColor,
            ),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: const [
                Text("Đăng xuất",style: TextStyle(color: bLtitleColor,fontSize: 16,fontWeight: FontWeight.w400),),
                Icon(Icons.navigate_next),
              ],
            ),
            Container(
              height: 1,
              margin: EdgeInsets.symmetric(vertical: 20.0),
              color: linegreyColor,
            ),

            
          ],
        ),
      );
    }
  }
