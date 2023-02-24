import 'account/account_screen.dart';
import 'order/order_screen.dart';
import 'waiting/waiting_screen.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:getwidget/getwidget.dart';

class HomeCreen extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: buildAppBar(),
      // body: Center(child: ElevatedButton(onPressed: (){
      //   Navigator.push(
      //     context,
      //     MaterialPageRoute(builder: (context) =>  OrderCreen()),
      //   );
      // },
      //   child: const Text('Đơn hàng'),),),

      body: Center(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.center,
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            GFButton(
              onPressed: (){
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) =>  OrderScreen()),
                );
              },
              text: "Screen Đơn hàng",
              shape: GFButtonShape.square,
            ),
            GFButton(
              onPressed: (){
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) =>  WaitingScreen()),
                );
              },
              text: "Screen chờ lấy hàng",
              shape: GFButtonShape.square,
            ),

          ],
        ),
      ),
    );
  }
  AppBar buildAppBar(){
    return AppBar(
      backgroundColor: Colors.white,
      elevation: 0,
      // leading: IconButton(
      //   icon: Image.asset("assets/images/arrow-left.png"),
      //   onPressed: (){},
      // ),
      centerTitle: true,
      title: Text("Home", style: GoogleFonts.mulish(fontSize: 25),),
    );
  }

}



