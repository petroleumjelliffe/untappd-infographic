//
//  BIGAppDelegate.h
//  Beer Infograph
//
//  Created by Roberto Osorio on 6/4/12.
//  Copyright (c) 2012 Malloc Media L.L.C. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface BIGAppDelegate : UIResponder <UIApplicationDelegate>

@property (strong, nonatomic) UIWindow *window;

@property (readonly, strong, nonatomic) NSManagedObjectContext *managedObjectContext;
@property (readonly, strong, nonatomic) NSManagedObjectModel *managedObjectModel;
@property (readonly, strong, nonatomic) NSPersistentStoreCoordinator *persistentStoreCoordinator;

- (void)saveContext;
- (NSURL *)applicationDocumentsDirectory;

@end
