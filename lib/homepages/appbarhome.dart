import 'package:flutter/material.dart';
import '../cart/cart_screen.dart';
import '../constants.dart';

class AppBarHome extends StatelessWidget {
  const AppBarHome({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      child: Row(
        children: [
          Container(
            margin: EdgeInsets.only(right: 10),
            child: Image.asset("assets/images/logoshop.png"),
          ),
          Container(
            margin: const EdgeInsets.only(right: 10),
            child: const Text("La Rosa’s",style: TextStyle(fontWeight: FontWeight.w400,fontSize: 20,color: blackColor),),
          ),
          const Spacer(),
          Badge(
            child: InkWell(
              onTap: () => Navigator.push(context, MaterialPageRoute(builder: (context) => CartScreen(),)),
              child: const Icon(
                Icons.shopping_bag_outlined,
              ),
            ),
          ),
        ],
      ),
    );
  }
}
